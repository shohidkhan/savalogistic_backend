<?php

namespace Database\Seeders;

use App\Models\DynamicPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DynamicPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DynamicPage::insert([
            [
                "page_title"=> "Terms of Service",
                "page_slug"=> "terms-of-service",
                "page_content"=> "<p><strong>Use of Services</strong><br>You may access features like job applications, contact forms, destination info, supplier/driver dashboards, and business tools. Use must be lawful and respectful.<br><strong>Accounts</strong><br>Some features require registration. Keep your login info safe. You're responsible for your account activity.<br><strong>Privacy</strong><br>We collect personal and logistic data to offer our services. Your data is safe and only used with your consent. See our Privacy Policy.<br><strong>Content &amp; Copyright</strong><br>All content is owned by SAVA or its partners. You may not copy, share, or use it without permission.<br><strong>Liability</strong><br>We are not responsible for losses from downtime, incorrect data, or third-party issues. Use the platform at your own risk.<br><strong>Changes</strong><br>We may update these terms at any time. Continued use means you accept the changes.<br><strong>Contact</strong><br>Questions? Contact us at: <a href='https://www.savaexpress.com'>www.savaexpress.com</a></p>",
            ],
            [
                "page_title"=> "Privacy Policy",
                "page_slug"=> "privacy-policy",
                "page_content"=> "<p><strong>We Collect:</strong><br>- Personal information such as your name and email address<br>- Data related to logistics and service interactions<br>- Information on how you navigate our website<br><br><strong>We Use It To:</strong><br>- Address your questions and feedback<br>- Provide you with insightful dashboards and tools<br>- Enhance the overall functionality of our site<br><br>We respect your privacy and do not sell your data. We only share it with trusted partners or as legally required. You have the right to request access, corrections, or deletion of your data at any time. Your information is securely stored. For inquiries, please contact us at: [Insert Email]</p>",
            ],
        ]);
    }
}
