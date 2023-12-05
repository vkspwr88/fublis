<?php

namespace App\Services;

use App\Http\Controllers\Users\Architects\MediaKitController;
use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\TagController;
use App\Models\Article;
use App\Models\PressRelease;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class AddStoryService
{
	public function addPressRelease(array $details)
	{
		try{
            DB::beginTransaction();
			// create press release
			$pressRelease = PressRelease::create([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/press-releases/cover-images'),
				'title' => $details['pressReleaseTitle'],
				'image_credits' => $details['imageCredits'],
				'concept_note' => $details['conceptNote'],
				'press_release_writeup' => $details['pressReleaseWrite'],
				'press_release_doc_path' => $details['pressReleaseFile'] ? FileController::upload($details['pressReleaseFile'], 'documents/press-releases') : null,
				'press_release_doc_link' => $details['pressReleaseLink'],
				'photographs_link' => $details['photographsLink'],
			]);
			// create media kit
			MediaKitController::createMediaKit($pressRelease, [
				'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
			]);
			// create images
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $photograph){
					ImageController::create($pressRelease->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($photograph, 'images/press-releases/photographs'),
					]);
				}
			}
			// create tags
			TagController::attachTags($pressRelease, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();

			dd($exp->getMessage());
            //Session::flash('message', $exp->getMessage());
            //Session::flash('message', 'Unable to process the order. Please contact support.');
            //Session::flash('alert-class', 'alert-danger');
            return false;
        }
		return true;
	}

	public function editPressRelease(string $mediaKitId, array $details)
	{
		try{
            DB::beginTransaction();

			// create press release
			$pressRelease = PressRelease::create([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/press-releases/cover-images'),
				'title' => $details['pressReleaseTitle'],
				'image_credits' => $details['imageCredits'],
				'concept_note' => $details['conceptNote'],
				'press_release_writeup' => $details['pressReleaseWrite'],
				'press_release_doc_path' => $details['pressReleaseFile'] ? FileController::upload($details['pressReleaseFile'], 'documents/press-releases') : null,
				'press_release_doc_link' => $details['pressReleaseLink'],
				'photographs_link' => $details['photographsLink'],
			]);
			// create media kit
			$pressRelease->mediakit()
							->create([
								'architect_id' => auth()->user()->architect->id,
								'category_id' => $details['category'],
							]);
			// create images
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $photograph){
					ImageController::create($pressRelease->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($photograph, 'images/press-releases/photographs'),
					]);
				}
			}
			// create tags
			TagController::attachTags($pressRelease, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();

			dd($exp->getMessage());
            //Session::flash('message', $exp->getMessage());
            //Session::flash('message', 'Unable to process the order. Please contact support.');
            //Session::flash('alert-class', 'alert-danger');
            return false;
        }
		return true;
	}

	public function addProject(array $details)
	{
		try{
            DB::beginTransaction();
			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCity'],
			]);
			// create project
			$project = Project::create([
				'title' => $details['projectTitle'],
				'site_area' => $details['siteArea'],
				'site_area_id' => $details['siteAreaUnit'],
				'built_up_area' => $details['builtUpArea'],
				'built_up_area_id' => $details['builtUpAreaUnit'],
				'location_id' => $location->id,
				'project_status_id' => $details['status'],
				'materials' => $details['materials'],
				'building_typology_id' => $details['buildingTypology'],
				'image_credits' => $details['imageCredits'],
				'text_credits' => $details['textCredits'],
				'render_credits' => $details['renderCredits'],
				'consultants' => $details['consultants'],
				'design_team' => $details['designTeam'],
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/projects/cover-images'),
				'project_brief' => $details['projectBrief'],
				'project_doc_path' => $details['projectFile'] ? FileController::upload($details['projectFile'], 'documents/projects') : null,
				'project_doc_link' => $details['projectLink'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
			]);
			// create media kit
			MediaKitController::createMediaKit($project, [
				'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
			]);
			// create images (photographs)
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $image){
					ImageController::create($project->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($image, 'images/projects/photographs'),
					]);
				}
			}
			// create images (drawings)
			if(count($details['drawingsFiles']) > 0){
				foreach($details['drawingsFiles'] as $image){
					ImageController::create($project->photographs(), [
						'image_type' => 'drawings',
						'image_path' => FileController::upload($image, 'images/projects/drawings'),
					]);
				}
			}
			// create tags
			TagController::attachTags($project, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();

			dd($exp->getMessage());
            return false;
        }
		return true;
	}

	public function addArticle(array $details)
	{
		try{
            DB::beginTransaction();
			// create article
			$article = Article::create([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/articles/cover-images'),
				'title' => $details['articleTitle'],
				'text_credits' => $details['textCredits'],
				'preview_text' => $details['previewText'],
				'article_doc_path' => $details['articleFile'] ? FileController::upload($details['articleFile'], 'documents/articles') : null,
				'article_doc_link' => $details['articleLink'],
				'article_writeup' => $details['articleWrite'],
				'company_profile_path' => $details['companyProfileFile'] ? FileController::upload($details['companyProfileFile'], 'documents/articles/company-profiles') : null,
				'company_profile_link' => $details['companyProfileLink'],
				'images_link' => $details['imagesLink'],
			]);
			// create media kit
			// create media kit
			MediaKitController::createMediaKit($article, [
				'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
			]);
			// create images
			if(count($details['imagesFiles']) > 0){
				foreach($details['imagesFiles'] as $image){
					ImageController::create($article->images(), [
						'image_type' => 'images',
						'image_path' => FileController::upload($image, 'images/articles/images'),
					]);
				}
			}
			// create tags
			TagController::attachTags($article, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();

			dd($exp->getMessage());
            return false;
        }
		return true;
	}
}
