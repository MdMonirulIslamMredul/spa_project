<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Parse pricing & duration tiers from service_details
     *
     * @return array
     */
    public function getPriceTiersAttribute(): array
    {
        $text = $this->service_details ?? '';
        if (empty($text)) {
            return [];
        }

        // Match lines like: "• 30 Minutes — 3,500 TK or $30" or "60 Minutes - 8,000 TK"
        preg_match_all(
            '/(?:(\d+\s*Minutes?|\d+\s*Mins?)\s*[\—\–\-–\:]\s*)?([0-9,]+)\s*(?:TK|Tk|৳|taka|bdt)(?:\s*(?:or|\/)?\s*\$([0-9,]+))?/iu',
            $text,
            $matches,
            PREG_SET_ORDER
        );

        $tiers = [];
        foreach ($matches as $m) {
            $duration = !empty($m[1]) ? trim($m[1]) : '';
            $bdt = !empty($m[2]) ? (int) str_replace(',', '', $m[2]) : null;
            $usd = !empty($m[3]) ? (int) str_replace(',', '', $m[3]) : null;

            if ($bdt || $usd) {
                $tiers[] = [
                    'duration' => $duration,
                    'bdt' => $bdt,
                    'usd' => $usd,
                ];
            }
        }

        return $tiers;
    }

    /**
     * Dynamic starting price in BDT (lowest TK in service_details)
     *
     * @return string|null
     */
    public function getPriceAttribute()
    {
        $tiers = $this->price_tiers;
        $bdtPrices = array_filter(array_column($tiers, 'bdt'));

        if (!empty($bdtPrices)) {
            return number_format(min($bdtPrices));
        }

        // Secondary regex fallback for standalone TK amounts
        $text = $this->service_details ?? '';
        if (preg_match_all('/([0-9,]+)\s*(?:TK|Tk|৳|taka|bdt)/iu', $text, $bdtMatches)) {
            $amounts = [];
            foreach ($bdtMatches[1] as $bm) {
                $val = (int) str_replace(',', '', $bm);
                if ($val > 0) {
                    $amounts[] = $val;
                }
            }
            if (!empty($amounts)) {
                return number_format(min($amounts));
            }
        }

        return $this->attributes['price'] ?? null;
    }

    /**
     * Dynamic starting price in USD (lowest Dollar in service_details)
     *
     * @return string|null
     */
    public function getPriceDollarAttribute()
    {
        $tiers = $this->price_tiers;
        $usdPrices = array_filter(array_column($tiers, 'usd'));

        if (!empty($usdPrices)) {
            return number_format(min($usdPrices));
        }

        // Secondary regex fallback for standalone dollar amounts e.g. "$30"
        $text = $this->service_details ?? '';
        if (preg_match_all('/\$([0-9,]+)/', $text, $dollarMatches)) {
            $amounts = [];
            foreach ($dollarMatches[1] as $dm) {
                $val = (int) str_replace(',', '', $dm);
                if ($val > 0) {
                    $amounts[] = $val;
                }
            }
            if (!empty($amounts)) {
                return number_format(min($amounts));
            }
        }

        return $this->attributes['price_dollar'] ?? null;
    }
}
