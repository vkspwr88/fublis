<?php

namespace Database\Seeders;

use App\Models\BuildingTypology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingTypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'Commercial',
				'use' => [
					[
						'name' => 'Bank'
					],
					[
						'name' => 'Distribution Centre'
					],
					[
						'name' => 'Exhibition Centre'
					],
					[
						'name' => 'Office'
					],
					[
						'name' => 'Trade Show'
					],
					[
						'name' => 'Shop'
					],
					[
						'name' => 'Shopping Centre'
					],
					[
						'name' => 'Showroom'
					],
					[
						'name' => 'Supermarket'
					],
					[
						'name' => 'Warehouse'
					],
				],
			],
			[
				'name' => 'Cultural',
				'use' => [
					[
						'name' => 'Art Gallery'
					],
					[
						'name' => 'Concert Hall'
					],
					[
						'name' => 'Cultural Centre'
					],
					[
						'name' => 'Exhibition'
					],
					[
						'name' => 'Memorial'
					],
					[
						'name' => 'Museum'
					],
					[
						'name' => 'Pavillion'
					],
					[
						'name' => 'Sculpture'
					],
					[
						'name' => 'Theatre'
					],
				],
			],
			[
				'name' => 'Educational',
				'use' => [
					[
						'name' => 'Auditorium'
					],
					[
						'name' => 'Day Care'
					],
					[
						'name' => 'Institute'
					],
					[
						'name' => 'Kindergarten'
					],
					[
						'name' => 'Library'
					],
					[
						'name' => 'Nursery'
					],
					[
						'name' => 'Primary School'
					],
					[
						'name' => 'Research Centre'
					],
					[
						'name' => 'Secondary School'
					],
					[
						'name' => 'University'
					],
					[
						'name' => 'Workshops'
					],
				],
			],
			[
				'name' => 'Healthcare',
				'use' => [
					[
						'name' => 'Animal Shelter'
					],
					[
						'name' => 'Asylum'
					],
					[
						'name' => 'Care Homes'
					],
					[
						'name' => 'Clinic'
					],
					[
						'name' => 'Dental Clinic'
					],
					[
						'name' => 'Healthcare Centre'
					],
					[
						'name' => 'Hospitals'
					],
					[
						'name' => 'Laboratory'
					],
					[
						'name' => 'Medical Facilities'
					],
					[
						'name' => 'Rehabilitation Center'
					],
					[
						'name' => 'Retirement'
					],
					[
						'name' => 'Veterinary Clinic'
					],
				],
			],
			[
				'name' => 'Industrial',
				'use' => [
					[
						'name' => 'Brewery'
					],
					[
						'name' => 'Distribution Centre'
					],
					[
						'name' => 'Factory'
					],
					[
						'name' => 'Farm'
					],
					[
						'name' => 'Laboratory'
					],
					[
						'name' => 'Mill'
					],
					[
						'name' => 'Power Plant'
					],
					[
						'name' => 'Pump Station'
					],
					[
						'name' => 'Research Facility'
					],
					[
						'name' => 'Warehouse'
					],
					[
						'name' => 'Winery'
					],
				],
			],
			[
				'name' => 'Interior Design',
				'use' => [
					[
						'name' => 'Cultural Interior'
					],
					[
						'name' => 'Educational Interior'
					],
					[
						'name' => 'HealthCare Interior'
					],
					[
						'name' => 'Hospitality Interior'
					],
					[
						'name' => 'Office Interior'
					],
					[
						'name' => 'Residential Interior'
					],
					[
						'name' => 'Retail Interior'
					],
					[
						'name' => 'Sports Interior'
					],

				],
			],
			[
				'name' => 'Landscape',
				'use' => [
					[
						'name' => 'Coast'
					],
					[
						'name' => 'Commercial Landscape'
					],
					[
						'name' => 'Heritage'
					],
					[
						'name' => 'Individual Building'
					],
					[
						'name' => 'Masterplan'
					],
					[
						'name' => 'Private Garden'
					],
					[
						'name' => 'Public Park'
					],
					[
						'name' => 'Residential Landscape'
					],
					[
						'name' => 'Rural'
					],
					[
						'name' => 'Townsape'
					],
					[
						'name' => 'Transport'
					],
					[
						'name' => 'Urban Green Space'
					],
					[
						'name' => 'Waterway/ Wetland'
					],

				],
			],
			[
				'name' => 'Mixed Use',
				'use' => [
					[
						'name' => 'Mixed Use'
					],
				],
			],
			[
				'name' => 'Public Architecture',
				'use' => [
					[
						'name' => 'Community Centre'
					],
					[
						'name' => 'Consulate'
					],
					[
						'name' => 'Courthouse'
					],
					[
						'name' => 'Embassy'
					],
					[
						'name' => 'Fire Station'
					],
					[
						'name' => 'Military Building'
					],
					[
						'name' => 'Municipal Building'
					],
					[
						'name' => 'Palace'
					],
					[
						'name' => 'Parliament'
					],
					[
						'name' => 'Police Stations'
					],
					[
						'name' => 'Post Office'
					],
					[
						'name' => 'Prison'
					],
					[
						'name' => 'Public Administration Building'
					],
					[
						'name' => 'Town & City Hall'
					],
				],
			],
			[
				'name' => 'Recreational',
				'use' => [
					[
						'name' => 'Bar'
					],
					[
						'name' => 'Casino'
					],
					[
						'name' => 'Cinema'
					],
					[
						'name' => 'Hotel'
					],
					[
						'name' => 'Information Centre'
					],
					[
						'name' => 'Golf Course'
					],
					[
						'name' => 'Nighclub'
					],
					[
						'name' => 'Park'
					],
					[
						'name' => 'Playground'
					],
					[
						'name' => 'Restaurant'
					],
					[
						'name' => 'Skatepark'
					],
					[
						'name' => 'Sports Centre'
					],
					[
						'name' => 'Stadium'
					],
					[
						'name' => 'Swimmig Pool'
					],
					[
						'name' => 'Theme Park'
					],
					[
						'name' => 'Visitor Centre'
					],
					[
						'name' => 'Wellness Centre'
					],
					[
						'name' => 'Yacht'
					],
					[
						'name' => 'Zoo'
					],
				],
			],
			[
				'name' => 'Religious',
				'use' => [
					[
						'name' => 'Cathedral'
					],
					[
						'name' => 'Cemetry'
					],
					[
						'name' => 'Chapel'
					],
					[
						'name' => 'Church'
					],
					[
						'name' => 'Crematorium'
					],
					[
						'name' => 'Memorial Space'
					],
					[
						'name' => 'Monastery'
					],
					[
						'name' => 'Mosque'
					],
					[
						'name' => 'Synagogue'
					],
					[
						'name' => 'Temple'
					],
				],
			],
			[
				'name' => 'Residential',
				'use' => [
					[
						'name' => 'Apartment'
					],
					[
						'name' => 'Housing'
					],
					[
						'name' => 'Nurse Housing'
					],
					[
						'name' => 'Private Houses'
					],
					[
						'name' => 'Senior Housing'
					],
					[
						'name' => 'Social Housing'
					],
					[
						'name' => 'Student Housing'
					],
				],
			],
			[
				'name' => 'Transport & Infrastructure',
				'use' => [
					[
						'name' => 'Airport'
					],
					[
						'name' => 'Aquaduct'
					],
					[
						'name' => 'Bicycle Stand'
					],
					[
						'name' => 'Boathouse'
					],
					[
						'name' => 'Bridge'
					],
					[
						'name' => 'Bridge Control Building'
					],
					[
						'name' => 'Bus Station'
					],
					[
						'name' => 'Car Park'
					],
					[
						'name' => 'Hanger'
					],
					[
						'name' => 'Marina'
					],
					[
						'name' => 'Passenger Terminal'
					],
					[
						'name' => 'Promenade'
					],
					[
						'name' => 'Sound Barrier'
					],
					[
						'name' => 'Subway Station'
					],
					[
						'name' => 'Train Station'
					],
					[
						'name' => 'Tram Stop'
					],
					[
						'name' => 'Tunnel'
					],
					[
						'name' => 'Watch Tower'
					],
					[
						'name' => 'Highway'
					],
				],
			],
			[
				'name' => 'Urban Design',
				'use' => [
					[
						'name' => 'Campus'
					],
					[
						'name' => 'Economic Development'
					],
					[
						'name' => 'Environmental'
					],
					[
						'name' => 'Infrastructure'
					],
					[
						'name' => 'Landscae Urbanism'
					],
					[
						'name' => 'Master Planning'
					],
					[
						'name' => 'Public Space'
					],
					[
						'name' => 'Redensification'
					],
					[
						'name' => 'Residential'
					],
					[
						'name' => 'SEZ'
					],
					[
						'name' => 'Smart City'
					],
					[
						'name' => 'Transport System'
					],
					[
						'name' => 'Urban Park'
					],
					[
						'name' => 'Urban Renewal'
					],
					[
						'name' => 'Urban Revitalization'
					],
				],
			],
			[
				'name' => 'Urban Planning',
				'use' => [
					[
						'name' => 'City'
					],
					[
						'name' => 'Economic Zone'
					],
					[
						'name' => 'Environmental'
					],
					[
						'name' => 'Estate'
					],
					[
						'name' => 'Municipal'
					],
					[
						'name' => 'National'
					],
					[
						'name' => 'Regional'
					],
					[
						'name' => 'Rural'
					],
					[
						'name' => 'Street'
					],
					[
						'name' => 'Town'
					],
					[
						'name' => 'Village'
					],
				],
			],

		];

		foreach($data as $row){
			$buildingTypology = BuildingTypology::create([
				'name' => $row['name'],
			]);
			$buildingTypology->buildingUses()->createMany($row['use']);
		}
    }
}
