<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'question' => 'Is there a free trial available?',
				'answer' => 'Yes, you can try us for with free account with 3 Pitches every month on limited publications and journalists. It just takes 2 minutes to signup on Fublis and start pitching.',
				'sort_order' => 1,
			],
			[
				'question' => 'Can I change my plan later?',
				'answer' => 'Of course. Our pricing scales with your company. Chat to our friendly team to find a solution that works for you.',
				'sort_order' => 2,
			],
			[
				'question' => 'Is there a monthly plan available?',
				'answer' => 'No, Fublis does not offer a monthly plan. We believe in delivering sustainable and impactful results for our users\' PR needs, which requires time, patience, and dedication. Instead, we offer quarterly and annually plans to ensure satisfaction and positive outcomes. Our longer-term plans are designed to provide ample time for pitching, follow-up with journalists, and achieving meaningful media coverage. With Fublis, our aim is to build lasting relationships with journalists and secure quality placements for our users over time.',
				'sort_order' => 3,
			],
			[
				'question' => 'What is Fublis?',
				'answer' => 'Fublis is a revolutionary PR platform that connects brands, startups, architects, designers, and creators with journalists, publishers, and industry influencers. Our platform streamlines the PR process, making it easier for users to showcase their projects, press releases, and articles to a global audience.',
				'sort_order' => 4,
			],
			[
				'question' => 'How does Fublis work?',
				'answer' => 'Fublis works by allowing users to create customized media kits that showcase their stories in a professional and compelling format. Users can then pitch their media kits to journalists and publishers directly through the platform, increasing their chances of securing media coverage and exposure with guaranteed publication.',
				'sort_order' => 5,
			],
			[
				'question' => 'Who can benefit from using Fublis?',
				'answer' => 'Fublis is designed to benefit a wide range of users, including brands, startups, architects, designers, creators, and PR professionals. Whether you\'re looking to promote a new product, share a compelling story, or attract media attention, Fublis can help you achieve your PR goals.',
				'sort_order' => 6,
			],
			[
				'question' => 'Is Fublis easy to use?',
				'answer' => 'Yes, Fublis is designed to be user-friendly and intuitive, with a simple interface that makes it easy for users to create media kits, pitch to journalists, and track their PR efforts. Our platform is accessible to users of all skill levels, from beginners to experienced PR professionals.',
				'sort_order' => 7,
			],
			[
				'question' => 'What types of projects can I pitch?',
				'answer' => 'Fublis allows users to showcase a wide range of projects, press releases, articles, and stories across various industries and sectors. Whether you\'re launching a new product, Designed a new project, secured a funding round, announcing a milestone or new hire, or sharing an industry insight, Fublis provides a platform to amplify your message and reach a wider audience.',
				'sort_order' => 8,
			],
			[
				'question' => 'Can I track the performance of my media kits on Fublis?',
				'answer' => 'Yes, Fublis provides comprehensive analytics tracking that allows users to monitor the performance of their media kits in real-time. Users can track metrics such as views, and downloads, gaining valuable insights into the effectiveness of their PR efforts.',
				'sort_order' => 9,
			],
			[
				'question' => 'Can I target specific journalists or publications with my pitches on Fublis?',
				'answer' => 'Yes, Fublis allows users to target specific journalists, bloggers, or publications based on their preferences and criteria. Users can filter journalists by industry, location, and more, ensuring that their pitches are tailored to the right audience for maximum impact.',
				'sort_order' => 10,
			],
			[
				'question' => 'Can I collaborate with team members on Fublis?',
				'answer' => 'Yes, Fublis offers collaborative features that allow users to work together with team members on PR campaigns and projects. Users can invite team members to collaborate on media kits, share insights and feedback, and coordinate their PR efforts seamlessly through the platform.',
				'sort_order' => 11,
			],
			[
				'question' => 'Does Fublis provide guidance on crafting effective pitches and media kits?',
				'answer' => 'Yes, Fublis offers resources and guidance to help users craft compelling pitches and media kits that resonate with journalists and publishers. From pitching best practices to media kit templates and examples, Fublis equips users with the tools and knowledge needed to succeed in PR.',
				'sort_order' => 12,
			],
			[
				'question' => 'How does Fublis handle follow-up communications with journalists?',
				'answer' => 'Fublis provides users with the ability to engage in real-time chat with journalists, allowing for direct communication and follow-up on media pitches. Users can respond to inquiries, provide additional information, and build relationships with journalists to increase the likelihood of their stories being picked up.',
				'sort_order' => 13,
			],
			[
				'question' => 'How does Fublis ensure the privacy and security of user information?',
				'answer' => 'Fublis takes privacy and security seriously and implements robust measures to protect user information. We use encryption and secure protocols to safeguard user data, and we do not share user information with third parties without consent. Our platform is designed to comply with data protection regulations and industry best practices to ensure a safe and secure user experience.',
				'sort_order' => 14,
			],
			[
				'question' => 'Does Fublis offer customer support and assistance to users?',
				'answer' => 'Yes, Fublis provides dedicated customer support to assist users with any questions, issues, or concerns they may have. Our support team is available to provide guidance, troubleshoot technical issues, and ensure that users have a positive experience with the platform.',
				'sort_order' => 15,
			],
		];

		foreach($data as $row){
			Faq::create($row);
		}
    }
}
