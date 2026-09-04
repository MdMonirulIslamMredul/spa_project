<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinationDir = public_path('backend_img/blogs');
        if (!File::isDirectory($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true, true);
        }

        // Mapping of source files to destination images
        $imageMap = [
            'thai_banner.jpg'     => public_path('setting/banner/service_thai_traditional_massage.jpg'),
            'thai_thumb.jpg'      => public_path('frontend_assets/img/service-1.jpg'),
            'aroma_banner.jpg'    => public_path('setting/banner/service_aroma_oil_massage.jpg'),
            'aroma_thumb.jpg'     => public_path('frontend_assets/img/service-2.jpg'),
            'deep_banner.jpg'     => public_path('setting/banner/service_full_body_massage.jpg'),
            'deep_thumb.jpg'      => public_path('frontend_assets/img/service-3.jpg'),
            'stone_banner.jpg'    => public_path('frontend_assets/img/about-philosophy.jpg'),
            'stone_thumb.jpg'     => public_path('frontend_assets/img/spa_care.jpg'),
            'foot_banner.jpg'     => public_path('setting/banner/service_foot_massage.jpg'),
            'foot_thumb.jpg'      => public_path('frontend_assets/img/service-inner-1.jpg'),
            'aftercare_banner.jpg'=> public_path('setting/banner/service_special_package.jpg'),
            'aftercare_thumb.jpg' => public_path('frontend_assets/img/skin_care.jpg'),
        ];

        foreach ($imageMap as $destFilename => $sourcePath) {
            $destPath = $destinationDir . DIRECTORY_SEPARATOR . $destFilename;
            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $destPath);
            }
        }

        // Clean out existing placeholder/bogus blogs
        DB::table('blog_models')->truncate();

        $blogs = [
            [
                'blog_ban_title' => 'Ancient Healing & Body Alignment',
                'blog_ban_img'   => 'thai_banner.jpg',
                'blog_title'     => 'The Ancient Art and Healing Powers of Traditional Thai Massage',
                'blog_img'       => 'thai_thumb.jpg',
                'blog_sort'      => 'Discover how centuries-old Thai massage combining rhythmic acupressure and assisted yoga stretches restores vital energy, increases flexibility, and melts away tension.',
                'blog_long'      => "Traditional Thai massage, known in Thailand as Nuad Bo-Rarn, is an ancient healing system that traces its roots back over 2,500 years. Unlike conventional Western massage styles that focus purely on rubbing muscles with oils, traditional Thai massage incorporates gentle stretching, assisted yoga poses, and targeted pressure along the body's primary energy lines, known as 'Sen' lines.\r\n\r\nDuring a traditional Thai massage session, you remain comfortably clothed in loose attire while the therapist guides your body through a harmonious sequence of movements. By using thumbs, palms, forearms, knees, and feet, the practitioner gently compresses tired muscles, mobilizes stiff joints, and opens energy pathways.\r\n\r\nKey Benefits of Traditional Thai Massage:\r\n1. Significant Reduction in Muscle Tension & Pain: Deep rhythmic compression softens tense fascia and stubborn muscular knots.\r\n2. Enhanced Flexibility & Joint Mobility: Passive stretching lengthens shortened ligaments, improving posture and overall range of motion.\r\n3. Boosted Blood & Lymphatic Circulation: Dynamic stretches and rhythmic pressure stimulate blood flow, promoting cellular oxygenation and detoxification.\r\n4. Deep Mental Calm & Stress Reduction: The meditative, flowing rhythm of the session activates the parasympathetic nervous system, lowering cortisol levels and fostering serenity.\r\n\r\nWhether you spend long hours working at a desk or lead an intensely active lifestyle, traditional Thai massage offers a restorative experience that realigns both body and spirit.",
                'is_active'      => 1,
                'created_at'     => Carbon::now()->subDays(12),
                'updated_at'     => Carbon::now()->subDays(12),
            ],
            [
                'blog_ban_title' => 'Awaken Your Senses with Aromatherapy',
                'blog_ban_img'   => 'aroma_banner.jpg',
                'blog_title'     => 'Aromatherapy Massage: Unlocking Deep Relaxation with Pure Essential Oils',
                'blog_img'       => 'aroma_thumb.jpg',
                'blog_sort'      => 'Immerse yourself in therapeutic herbal scents and gentle flowing strokes designed to melt away daily stress, soothe nervous exhaustion, and revitalize your skin.',
                'blog_long'      => "Aromatherapy massage combines the healing touch of skilled hands with the therapeutic botanical power of pure essential oils. Extracted from aromatic flowers, herbs, trees, and fruits, these natural essences penetrate the skin while their fragrance stimulates the olfactory system, triggering immediate positive responses in the brain's emotional center.\r\n\r\nAt our luxury spa, each aromatherapy session begins with a consultation to select the ideal oil blend for your individual wellness goals:\r\n- Lavender & Chamomile: Formulated for insomnia, nervous anxiety, and profound emotional calm.\r\n- Eucalyptus & Peppermint: Energizes the respiratory system, relieves sinus pressure, and invigorates tired muscles.\r\n- Lemongrass & Sweet Orange: Lifts the mood, stimulates circulation, and leaves the skin radiating warmth.\r\n- Ylang Ylang & Frankincense: Deeply meditative, balancing heart rate and grounding restless thoughts.\r\n\r\nTherapeutic Advantages:\r\n- Gentle Lymphatic Drainage: Soft, flowing Swedish strokes guide lymphatic fluid toward nodes, encouraging natural toxin clearance.\r\n- Nourished & Hydrated Skin: Cold-pressed carrier oils like sweet almond and jojoba provide deep moisture and vital antioxidants.\r\n- Improved Sleep Patterns: Regular aromatherapy sessions dramatically improve sleep quality, helping you awake feeling genuinely refreshed.\r\n\r\nTreat yourself to an aromatic retreat and let your senses guide you into a state of total tranquility.",
                'is_active'      => 1,
                'created_at'     => Carbon::now()->subDays(10),
                'updated_at'     => Carbon::now()->subDays(10),
            ],
            [
                'blog_ban_title' => 'Release Stubborn Knots & Muscular Strain',
                'blog_ban_img'   => 'deep_banner.jpg',
                'blog_title'     => 'Full Body Deep Tissue Massage: Solving Chronic Tension & Stiffness',
                'blog_img'       => 'deep_thumb.jpg',
                'blog_sort'      => 'Understand how deep tissue therapy targets underlying connective tissues, breaks down adhesions, and provides lasting relief from chronic neck, back, and shoulder pain.',
                'blog_long'      => "If you struggle with stubborn muscle tightness, persistent lower back discomfort, or recurring postural aches, a standard relaxation massage might only scratch the surface. Deep tissue massage is specifically designed to reach the deeper layers of muscle fibers and fascia, addressing the structural root causes of chronic pain.\r\n\r\nHow Deep Tissue Massage Works:\r\nTherapists apply slow, concentrated pressure and firm friction perpendicular to the grain of your muscle fibers. This specialized technique breaks down adhesions—bands of rigid, painful tissue commonly referred to as 'knots'—that disrupt circulation and cause inflammation.\r\n\r\nWhy You Should Choose Deep Tissue Therapy:\r\n1. Alleviates Chronic Back & Neck Discomfort: Ideal for individuals who sit at computer workstations or carry physical burdens throughout the day.\r\n2. Restores Postural Symmetry: By releasing chronically tight chest and upper back muscles, it enables your spine to rest in its natural alignment.\r\n3. Speeds Recovery After Exercise: Encourages rapid clearance of lactic acid and improves nutrient delivery to micro-torn muscle fibers.\r\n4. Lowers Heart Rate and Blood Pressure: Studies show that focused deep tissue therapy measurably reduces arterial tension and heart rate.\r\n\r\nAfter your session, remember to hydrate generously with fresh water to assist your body in flushing released metabolic byproducts. You will walk away feeling lighter, taller, and rejuvenated.",
                'is_active'      => 1,
                'created_at'     => Carbon::now()->subDays(7),
                'updated_at'     => Carbon::now()->subDays(7),
            ],
            [
                'blog_ban_title' => 'Deep Soothing Warmth for Total Peace',
                'blog_ban_img'   => 'stone_banner.jpg',
                'blog_title'     => 'The Therapeutic Warmth of Hot Stone Massage: Why It Heals So Deeply',
                'blog_img'       => 'stone_thumb.jpg',
                'blog_sort'      => 'Experience the comforting synergy of smooth volcanic basalt stones and warming botanical oils that penetrate deep into muscle layers to dissolve physical tightness.',
                'blog_long'      => "Hot stone therapy is one of the most comforting and deeply soothing treatments available in the spa world. Utilizing naturally smoothed, mineral-rich basalt stones heated to a precise, comfortable temperature, this treatment allows soothing heat to radiate into muscle tissues far faster than manual massage alone.\r\n\r\nWhy Volcanic Basalt Stones?\r\nBasalt is volcanic rock with high iron and magnesium content, enabling it to retain soothing heat for extended durations. The therapist gently glides the warm, oiled stones over key energy centers, shoulders, back, and palms, infusing therapeutic heat into stiffened muscles.\r\n\r\nMajor Health Benefits:\r\n- Rapid Muscle Softening: The penetrating heat allows the therapist to work deep tissues without causing sharp discomfort.\r\n- Expansion of Blood Vessels: Increased thermal energy widens capillaries, vastly improving localized circulation and nutrient distribution.\r\n- Relief from Symptoms of Fibromyalgia & Arthritis: Warmth provides natural analgesic pain relief and relieves chronic joint stiffness.\r\n- Mental Euphoria and Stress Relief: The grounding weight and warmth of the stones induce a meditative state that quiets overactive minds.\r\n\r\nStep into a sanctuary of warmth and let the ancient healing power of heated stones melt your worries away.",
                'is_active'      => 1,
                'created_at'     => Carbon::now()->subDays(5),
                'updated_at'     => Carbon::now()->subDays(5),
            ],
            [
                'blog_ban_title' => 'Restoring Balance Through Reflexology',
                'blog_ban_img'   => 'foot_banner.jpg',
                'blog_title'     => 'Foot Reflexology: Healing Your Entire Body from the Soles Up',
                'blog_img'       => 'foot_thumb.jpg',
                'blog_sort'      => 'Learn how targeted acupressure on specific zones of your feet stimulates internal organs, boosts immune defense, and banishes heavy leg fatigue.',
                'blog_long'      => "In traditional holistic medicine, your feet are viewed as a comprehensive mirror of your entire body. Containing more than 7,000 sensitive nerve endings, the soles of your feet house distinct reflex zones that correspond directly to every major gland, organ, and bodily system.\r\n\r\nThe Science and Art of Reflexology:\r\nBy applying precise thumb and finger pressure techniques to these reflex points, a skilled reflexologist clears blockages, stimulates nerve pathways, and helps your internal organs achieve natural homeostatic balance.\r\n\r\nTransformative Benefits of Foot Reflexology:\r\n1. Soothes Fatigued Feet & Legs: Reverses the swelling and strain caused by prolonged standing, high heels, or daily walking.\r\n2. Supports Healthy Digestion: Specific reflex points along the arches stimulate the stomach, liver, and intestines, promoting natural digestion.\r\n3. Eases Headaches & Sinus Congestion: Massaging the tips of the toes relieves tension stored in the head, neck, and cranial nerves.\r\n4. Boosts Immunity & Detoxification: Stimulating lymphatic zones in the ankles and feet aids the body in filtering waste efficiently.\r\n\r\nComplement your reflexology session with a warm herbal foot soak infused with sea salts and essential oils for the quintessential restorative ritual.",
                'is_active'      => 1,
                'created_at'     => Carbon::now()->subDays(3),
                'updated_at'     => Carbon::now()->subDays(3),
            ],
            [
                'blog_ban_title' => 'Sustain Your Wellness Glow',
                'blog_ban_img'   => 'aftercare_banner.jpg',
                'blog_title'     => 'Essential Post-Massage Care: 6 Tips to Extend Your Spa Experience',
                'blog_img'       => 'aftercare_thumb.jpg',
                'blog_sort'      => 'Maximize the long-term benefits of your spa treatment with these simple, effective aftercare habits that keep muscles supple and vitality high.',
                'blog_long'      => "You have just concluded a heavenly, restorative massage at our spa. Your muscles feel loose, your mind is at peace, and your stress has dissolved. To make this feeling of wellness last for days, mindful aftercare is vital.\r\n\r\nHere are 6 essential post-massage care guidelines recommended by our expert wellness therapists:\r\n\r\n1. Hydrate Extensively:\r\nMassage releases metabolic waste from tight muscle fibers into the bloodstream. Drinking plenty of warm water or herbal infusion (like ginger or lemongrass tea) helps your kidneys flush these toxins effortlessly.\r\n\r\n2. Avoid Strenuous Workouts:\r\nGive your muscles 24 hours to recover and integrate the structural changes. Choose a gentle stroll or light stretching over intense gym sessions.\r\n\r\n3. Take a Warm Epsom Salt Bath:\r\nIf you experience mild soreness the next day, a warm bath with magnesium-rich Epsom salts helps soothe muscle fibers and induces restorative sleep.\r\n\r\n4. Eat Clean, Light Meals:\r\nYour body’s energy is focused on repair and relaxation. Opt for fresh salads, soups, steamed vegetables, and lean proteins rather than heavy, greasy foods.\r\n\r\n5. Rest and Unplug:\r\nProtect your newfound serenity by taking a break from bright screens and stressful tasks. Allow yourself an early bedtime to support cellular rejuvenation.\r\n\r\n6. Schedule Regular Sessions:\r\nConsistency is the cornerstone of preventive health. Regular monthly or bi-weekly spa treatments keep chronic pain at bay and support sustainable vitality.",
                'is_active'      => 1,
                'created_at'     => Carbon::now()->subDay(),
                'updated_at'     => Carbon::now()->subDay(),
            ],
        ];

        DB::table('blog_models')->insert($blogs);
    }
}
