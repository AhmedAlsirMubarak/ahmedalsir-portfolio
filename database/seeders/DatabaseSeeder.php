<?php

namespace Database\Seeders;

use App\Models\{Certification, Education, Experience, Project, Setting, Skill, Testimonial};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        //admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'ahmedalsirmubarak@hotmail.com',
            'password' => bcrypt('Padmin@1122$'), // Replace with a secure password
        ]);

        // ── Settings ──────────────────────────────────────────────────────────
        $settings = [
            'name'            => 'Your Name',
            'title'           => 'Senior Software Engineer',
            'bio'             => 'I bridge the gap between complex engineering and Pixel-Perfect design. Specializing in building dynamic, scalable architectures with a deep-rooted UX mindset where 95% of my proactive design enhancements make it to the final product.',
            'about_text'      => "I'm a Senior Software Engineer specializing in Laravel, Vue.js, TypeScript, and MySQL. With over 5 years of experience, I've delivered high-performance, scalable web applications with expertise in integrating complex RESTful APIs and optimizing backend systems.\n\nI have a proven track record of success in Agile environments, leading cross-functional teams to consistently achieve and surpass project goals and client expectations.",
            'cv_url'          => '/cv/resume.pdf',
            'email'           => 'hello@yoursite.com',
            'whatsapp'        => '+1234567890',
            'linkedin'        => 'https://linkedin.com/in/yourprofile',
            'github'          => 'https://github.com/yourprofile',
            'years_exp'       => '5+',
            'projects_count'  => '50+',
            'satisfaction'    => '100%',
            'sprint_delivery' => '95%+',
            'available'       => '1',
            'meta_title'      => 'Your Name | Senior Software Engineer',
            'meta_description'=> 'Senior Software Engineer specializing in Laravel, Vue.js, TypeScript and scalable web applications.',
            'hero_tags'       => json_encode(['Laravel','Vue.js','TypeScript','MySQL','RESTful APIs','Tailwind CSS','React / Next.js']),
            'typed_phrases'   => json_encode(['Senior Software Engineer','Full Stack Developer','Laravel Expert','Open to Opportunities']),
            'about_badges'    => json_encode(['Top Rated Freelancer','Open to opportunities','Remote friendly','Agile Developer']),
            'footer_text'     => 'Scalable Code. High-Performance Systems. Exceptional Results. Available for high-impact collaborations.',
            'code_snippet'    => "const developer = {\n  name: \"Your Name\",\n  title: \"Senior Software Engineer\",\n  skills: [\n    \"Laravel\", \"Vue.js\",\n    \"TypeScript\", \"MySQL\"\n  ],\n  aiIntegration: true,\n  hireable: true\n};",
            'about_snippet'   => "interface SeniorEngineer {\n  experience: '5+ years';\n  mainStack: ['Laravel', 'Vue.js'];\n  focus: 'Scalable Architectures';\n  aiIntegration: true;\n};\n\nconst me: SeniorEngineer = {\n  status: 'Building the Future',\n  location: 'Remote / Worldwide',\n  openForNewChallenges: true\n};",
            'about_cards'     => json_encode([
                ['title' => 'Full Stack Development',   'desc' => 'Expert in Laravel, Vue.js, and building scalable RESTful APIs with high-performance architecture.'],
                ['title' => 'Frontend Development',     'desc' => 'Proficient in Vue.js, TypeScript, and creating responsive, SEO-optimized user interfaces.'],
                ['title' => 'Database & Backend',       'desc' => 'Experienced with MySQL optimization, Laravel Eloquent ORM, and robust API design.'],
                ['title' => 'AI Integration',           'desc' => 'Skilled in integrating AI-driven systems and RESTful APIs for real-time data communication.'],
            ]),
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // ── Skills ────────────────────────────────────────────────────────────
        $skills = [
            ['name'=>'Vue.js / Nuxt.js',    'category'=>'frontend','level'=>92,'sort_order'=>1],
            ['name'=>'TypeScript',           'category'=>'frontend','level'=>88,'sort_order'=>2],
            ['name'=>'JavaScript',           'category'=>'frontend','level'=>95,'sort_order'=>3],
            ['name'=>'Tailwind CSS',         'category'=>'frontend','level'=>93,'sort_order'=>4],
            ['name'=>'React / Next.js',      'category'=>'frontend','level'=>80,'sort_order'=>5],
            ['name'=>'Alpine.js',            'category'=>'frontend','level'=>85,'sort_order'=>6],
            ['name'=>'Responsive Design',    'category'=>'frontend','level'=>97,'sort_order'=>7],
            ['name'=>'Laravel',              'category'=>'backend', 'level'=>95,'sort_order'=>1],
            ['name'=>'PHP 8.2+',             'category'=>'backend', 'level'=>90,'sort_order'=>2],
            ['name'=>'RESTful APIs',         'category'=>'backend', 'level'=>93,'sort_order'=>3],
            ['name'=>'Filament CMS',         'category'=>'backend', 'level'=>90,'sort_order'=>4],
            ['name'=>'Laravel Queues',       'category'=>'backend', 'level'=>82,'sort_order'=>5],
            ['name'=>'WebSockets',           'category'=>'backend', 'level'=>78,'sort_order'=>6],
            ['name'=>'MySQL',                'category'=>'database','level'=>90,'sort_order'=>1],
            ['name'=>'Eloquent ORM',         'category'=>'database','level'=>95,'sort_order'=>2],
            ['name'=>'Redis',                'category'=>'database','level'=>75,'sort_order'=>3],
            ['name'=>'DB Optimization',      'category'=>'database','level'=>85,'sort_order'=>4],
            ['name'=>'Git & GitHub',         'category'=>'other',   'level'=>95,'sort_order'=>1],
            ['name'=>'Docker',               'category'=>'other',   'level'=>72,'sort_order'=>2],
            ['name'=>'CI/CD Pipelines',      'category'=>'other',   'level'=>78,'sort_order'=>3],
            ['name'=>'Agile / Scrum',        'category'=>'other',   'level'=>90,'sort_order'=>4],
        ];
        foreach ($skills as $s) Skill::create($s);

        // ── Projects ──────────────────────────────────────────────────────────
        $projects = [
            ['title'=>'My Portfolio Website','description'=>'A high-performance personal portfolio built with Laravel 12 + Filament v5 CMS and Tailwind CSS v4. Fully manageable from the admin panel, featuring smooth animations, dark-mode interface, and full SEO optimization.','image'=>'','tech_tags'=>['Laravel 12','Filament v5','Tailwind CSS v4','Alpine.js','MySQL'],'category'=>'web','featured'=>true,'sort_order'=>1,'live_url'=>'','repo_url'=>''],
            ['title'=>'AI-Driven SaaS Ecosystem','description'=>'A high-performance enterprise ecosystem designed to automate digital sales and lead management. Led the full-stack architecture transforming complex AI-driven requirements into a scalable, pixel-perfect reality.','image'=>'','tech_tags'=>['Laravel','Vue.js','Tailwind CSS','RESTful APIs','MySQL','AI Integration'],'category'=>'web','featured'=>true,'sort_order'=>2,'live_url'=>'','repo_url'=>''],
            ['title'=>'Real Estate ERP System','description'=>'A high-end, multi-lingual Real Estate ERP providing seamless property discovery for users and a robust data-driven dashboard for comprehensive administrative control.','image'=>'','tech_tags'=>['Laravel','Vue.js','MySQL','Tailwind CSS','i18n'],'category'=>'web','featured'=>false,'sort_order'=>3,'live_url'=>'','repo_url'=>''],
            ['title'=>'Logistics & Shipping Platform','description'=>'Smart logistics platform with real-time order tracking and fleet management. Integrated Google Maps API for precise location services and Firebase Cloud Messaging for real-time notifications.','image'=>'','tech_tags'=>['Laravel','Vue.js','Google Maps API','Firebase','MySQL'],'category'=>'web','featured'=>false,'sort_order'=>4,'live_url'=>'','repo_url'=>''],
            ['title'=>'E-Learning Ecosystem & CMS','description'=>'A robust ERP system designed to streamline complex business operations, focusing on intricate inventory management, real-time data tracking, and scalable architecture for large-scale workflows.','image'=>'','tech_tags'=>['Laravel','Vue.js','MySQL','REST APIs'],'category'=>'web','featured'=>false,'sort_order'=>5,'live_url'=>'','repo_url'=>''],
            ['title'=>'Multi-Vendor E-commerce Platform','description'=>'High-performance classified ads and business directory. A robust platform designed to streamline the buying and selling experience with advanced listings, business management tools, and real-time interaction.','image'=>'','tech_tags'=>['Laravel','Vue.js','MySQL','Stripe','Tailwind CSS'],'category'=>'web','featured'=>false,'sort_order'=>6,'live_url'=>'','repo_url'=>''],
            ['title'=>'Desktop Inventory Manager','description'=>'A desktop application for managing warehouse inventory with barcode scanning, automated restocking alerts, and detailed analytics reports. Backed by a Laravel API.','image'=>'','tech_tags'=>['Electron','Laravel API','Vue.js','SQLite'],'category'=>'desktop','featured'=>false,'sort_order'=>1,'live_url'=>'','repo_url'=>''],
            ['title'=>'POS System','description'=>'A full-featured Point of Sale desktop application with receipt printing, shift management, and real-time inventory sync to a central Laravel backend.','image'=>'','tech_tags'=>['Electron','Laravel','MySQL','Vue.js'],'category'=>'desktop','featured'=>false,'sort_order'=>2,'live_url'=>'','repo_url'=>''],
            ['title'=>'Arabic RTL Landing Page','description'=>'A professional, responsive Arabic landing page featuring modern UI/UX, full RTL support, and interactive filtering components. Achieved 98/100 Lighthouse performance score.','image'=>'','tech_tags'=>['HTML','JavaScript','Bootstrap','CSS','RTL'],'category'=>'other','featured'=>false,'sort_order'=>1,'live_url'=>'','repo_url'=>''],
        ];
        foreach ($projects as $p) Project::create($p);

        // ── Experiences ───────────────────────────────────────────────────────
        $experiences = [
            ['role'=>'Senior Full Stack Developer','company'=>'Tech Company','location'=>'Remote | Worldwide','duration'=>'1 year 6 months','type'=>'full-time','description'=>'Building enterprise web platforms and scalable APIs.','responsibilities'=>['Architect and build scalable Laravel APIs serving 100k+ monthly requests with 99.9% uptime.','Develop responsive Vue.js interfaces using Tailwind CSS, improving dashboard load speeds by 15%.','Lead and mentor a fullstack team, promoting best practices and ensuring high-quality code delivery.','Consistently deliver 95%+ of committed sprint tasks in an Agile environment.','Integrate WebSockets for real-time data synchronization, improving system responsiveness.','Optimize MySQL queries reducing average response time by 40%.'],'tech_tags'=>['Laravel 12','Vue.js','Tailwind CSS v4','MySQL','RESTful APIs','WebSockets'],'sort_order'=>1],
            ['role'=>'Software Engineer','company'=>'Upwork / Freelance','location'=>'Remote','duration'=>'1 year 4 months','type'=>'freelance','description'=>'Managed full SDLC from requirements gathering to deployment, delivering over 8 high-quality web applications.','responsibilities'=>['Delivered 8+ full-stack web applications end-to-end using Laravel and Vue.js.','Maintained 100% client satisfaction rate across all projects.','Implemented CI/CD pipelines with GitHub Actions for automated deployments.'],'tech_tags'=>['Laravel','Vue.js','MySQL','Tailwind CSS'],'sort_order'=>2],
            ['role'=>'Mid-Level Backend Developer','company'=>'Software Agency','location'=>'Remote','duration'=>'7 months','type'=>'full-time','description'=>'Developed scalable e-commerce platforms using Laravel, enabling users to list and purchase high-value assets.','responsibilities'=>['Built product catalog, cart, and checkout for a multi-vendor marketplace.','Integrated Stripe payment gateway with webhook support.','Wrote comprehensive feature tests achieving 80%+ code coverage.'],'tech_tags'=>['Laravel','MySQL','REST APIs','Stripe'],'sort_order'=>3],
            ['role'=>'Junior Software Engineer','company'=>'Startup','location'=>'On-site','duration'=>'1 year 5 months','type'=>'full-time','description'=>'Developed scalable e-commerce and ERP platforms, ensuring high performance and long-term maintainability.','responsibilities'=>['Built core ERP modules for HR, Finance, and Logistics.','Developed REST APIs consumed by mobile and web clients.','Participated in daily standups and sprint planning sessions.'],'tech_tags'=>['Laravel','PHP','MySQL','Bootstrap','jQuery'],'sort_order'=>4],
        ];
        foreach ($experiences as $e) Experience::create($e);

        // ── Education ─────────────────────────────────────────────────────────
        $educations = [
            ['degree'=>'Professional Diploma in Web Development','institution'=>'Information Technology Institute (ITI)','year'=>'2021','location'=>'Egypt','description'=>'Ranked 1st in the Freelance Expert course. Added to the ITI freelance experts network by the administration.','logo'=>'','sort_order'=>1],
            ['degree'=>"Bachelor's Degree in Computer Science",'institution'=>'University','year'=>'2020','location'=>'Egypt','description'=>"Bachelor's degree in Computer Science with Very Good grade.",'logo'=>'','sort_order'=>2],
        ];
        foreach ($educations as $e) Education::create($e);

        // ── Certifications ────────────────────────────────────────────────────
        $certs = [
            ['title'=>'Laravel Certification',      'issuer'=>'Laravel',         'date'=>'Jan 2024','url'=>'#','sort_order'=>1],
            ['title'=>'SEO Certification',          'issuer'=>'HubSpot Academy', 'date'=>'May 2024','url'=>'#','sort_order'=>2],
            ['title'=>'MySQL Performance Tuning',   'issuer'=>'Oracle',           'date'=>'Mar 2023','url'=>'#','sort_order'=>3],
            ['title'=>'Machine Learning Developer', 'issuer'=>'Google Cloud',     'date'=>'Apr 2021','url'=>'#','sort_order'=>4],
            ['title'=>'Docker Essentials',          'issuer'=>'Docker Inc.',      'date'=>'Dec 2023','url'=>'#','sort_order'=>5],
        ];
        foreach ($certs as $c) Certification::create($c);

        // ── Testimonials ──────────────────────────────────────────────────────
        Testimonial::create(['quote'=>'I highly recommend them as a Full Stack Leader with an exceptional sense of responsibility and strong UX mindset. They consistently take ownership of their work, ensure high-quality delivery, and hold themselves and their team to high standards.','name'=>'Product Manager','role'=>'Product Manager','company'=>'Tech Company','avatar'=>'','sort_order'=>1]);
        Testimonial::create(['quote'=>'Outstanding developer who delivered our platform ahead of schedule. Their deep Laravel knowledge and clean code practices made the entire project a breeze to maintain and extend.','name'=>'Startup Founder','role'=>'CEO','company'=>'SaaS Startup','avatar'=>'','sort_order'=>2]);
    }
}
