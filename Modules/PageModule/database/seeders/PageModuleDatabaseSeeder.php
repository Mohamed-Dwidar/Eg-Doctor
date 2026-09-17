<?php

namespace Modules\PageModule\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Modules\PageModule\app\Models\Page;

class PageModuleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        DB::table('pages')->truncate();
        Page::create([
            'title' => 'About Us',
            'parent_id' => 0,
            'slug' => 'about-us',
            'content' => '<p>Welcome to our website! We are dedicated to providing the best services and products to our customers. Our team is committed to excellence and customer satisfaction.</p>',
            'is_active' => 1,
            'meta_title' => 'About Us - Our Company',
            'meta_description' => 'Learn more about our company, our values, and our mission.',
            'meta_keywords' => 'about us, company, mission, values',
            'image' => 'about_us_image.png',
        ]);
        Page::create([
            'title' => 'Why Us',
            'parent_id' => 0,
            'slug' => 'why-us',
            'content' => '<p>Discover why we are the best choice for your needs. We offer unparalleled quality, exceptional customer service, and a commitment to innovation.</p>',
            'is_active' => 1,
            'meta_title' => 'Why Us - Choose the Best',
            'meta_description' => 'Find out why you should choose us for your next project or purchase.',
            'meta_keywords' => 'why us, best choice, quality, service',
            'image' => 'why_us_image.png',
        ]);
        Page::create([
            'title' => 'Our Vision',
            'parent_id' => 0,
            'slug' => 'our-vision',
            'content' => '<p>Our vision is to be a leader in our industry, setting the standard for quality and innovation. We strive to exceed expectations and deliver exceptional value to our customers.</p>',
            'is_active' => 1,
            'meta_title' => 'Our Vision - Leading the Industry',
            'meta_description' => 'Learn about our vision and how we plan to achieve it through innovation and excellence.',
            'meta_keywords' => 'vision, leadership, industry, innovation',
            'image' => 'our_vision_image.png',
        ]);
        Page::create([
            'title' => 'Our Mission',
            'parent_id' => 0,
            'slug' => 'our-mission',
            'content' => '<p>Our mission is to provide high-quality products and services that meet the needs of our customers. We are dedicated to continuous improvement and innovation to ensure customer satisfaction.</p>',
            'is_active' => 1,
            'meta_title' => 'Our Mission - Commitment to Quality',
            'meta_description' => 'Understand our mission and how we are committed to delivering quality and value to our customers.',
            'meta_keywords' => 'mission, quality, customer satisfaction, innovation',
            'image' => 'our_mission_image.png',
        ]);
        Page::create([
            'title' => 'Contact Us',
            'parent_id' => 0,
            'slug' => 'contact-us',
            'content' => '<p>If you have any questions or need assistance, please contact us through our contact form or reach us via email.</p>',
            'is_active' => 1,
            'meta_title' => 'Contact Us - Get in Touch',
            'meta_description' => 'Reach out to us for any inquiries or support.',
            'meta_keywords' => 'contact, support, inquiries',
            'image' => 'contact_us_image.png',
        ]);
        Page::create([
            'title' => 'Privacy Policy',
            'parent_id' => 0,
            'slug' => 'privacy-policy',
            'content' => '<p>Your privacy is important to us. This policy outlines how we collect, use, and protect your information.</p>',
            'is_active' => 1,
            'meta_title' => 'Privacy Policy - Your Privacy Matters',
            'meta_description' => 'Read our privacy policy to understand how we handle your personal information.',
            'meta_keywords' => 'privacy policy, data protection, personal information',
            'image' => 'privacy_policy_image.png',
        ]);
        Page::create([
            'title' => 'Terms of Service',
            'parent_id' => 0,
            'slug' => 'terms-of-service',
            'content' => '<p>By using our services, you agree to our terms and conditions. Please read them carefully.</p>',
            'is_active' => 1,
            'meta_title' => 'Terms of Service - User Agreement',
            'meta_description' => 'Understand the terms and conditions that govern your use of our services.',
            'meta_keywords' => 'terms of service, user agreement, conditions',
            'image' => 'terms_of_service_image.png',
        ]);
        Page::create([
            'title' => 'FAQ',
            'parent_id' => 0,
            'slug' => 'faq',
            'content' => '<p>Frequently Asked Questions. Find answers to common questions about our services and products.</p>',
            'is_active' => 1,
            'meta_title' => 'FAQ - Frequently Asked Questions',
            'meta_description' => 'Browse our FAQ section to find answers to your questions.',
            'meta_keywords' => 'faq, frequently asked questions, help',
            'image' => 'faq_image.png',
        ]);
    }
}
