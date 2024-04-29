<?php

namespace App\Services;

use App\Http\Controllers\ErrorLogController;
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
	public function addPressRelease(array $details, $draftId = null)
	{
		try{
            DB::beginTransaction();
			// create press release
			$pressRelease = PressRelease::create([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/press-releases/cover-images', 'press_release_cover_image'),
				'title' => $details['pressReleaseTitle'],
				'image_credits' => $details['imageCredits'],
				'concept_note' => $details['conceptNote'],
				'press_release_writeup' => $details['pressReleaseWrite'],
				'press_release_doc_path' => $details['pressReleaseFile'] ? FileController::upload($details['pressReleaseFile'], 'documents/press-releases', 'press_release_doc') : null,
				'press_release_doc_link' => $details['pressReleaseLink'],
				'photographs_link' => $details['photographsLink'],
			]);
			// create media kit
			MediaKitController::createMediaKit($pressRelease, [
				'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
				'audio_video_url' => $details['audioVideoUrl'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
			]);
			// create images
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $photograph){
					ImageController::create($pressRelease->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($photograph, 'images/press-releases/photographs', 'press_release_photographs'),
					]);
				}
			}
			// create tags
			TagController::attachTags($pressRelease, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'addPressRelease', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
            return false;
        }
		return true;
	}

	public function editPressRelease(string $mediaKitId, array $details)
	{
		try{
            DB::beginTransaction();

			// find media kit
			$mediaKit = MediaKitController::findById($mediaKitId);
			MediaKitController::isAuthorized($mediaKit);
			$pressRelease = $mediaKit->story;
			$slug = $mediaKit->slug;
			if($pressRelease->title != $details['pressReleaseTitle']){
				$slug = MediaKitController::generateSlug($details['pressReleaseTitle']);
			}

			// update media kit
			$mediaKit->update([
				// 'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
				'audio_video_url' => $details['audioVideoUrl'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
				'slug' => $slug,
			]);

			// update press release
			$pressRelease->update([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/press-releases/cover-images', 'press_release_cover_image_edit'),
				'title' => $details['pressReleaseTitle'],
				'image_credits' => $details['imageCredits'],
				'concept_note' => $details['conceptNote'],
				'press_release_writeup' => $details['pressReleaseWrite'],
				'press_release_doc_path' => $details['pressReleaseFile'] ? FileController::upload($details['pressReleaseFile'], 'documents/press-releases', 'press_release_doc_edit') : null,
				'press_release_doc_link' => $details['pressReleaseLink'],
				'photographs_link' => $details['photographsLink'],
			]);

			// create new images
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $photograph){
					ImageController::create($pressRelease->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($photograph, 'images/press-releases/photographs', 'press_release_photographs_edit'),
					]);
				}
			}

			// update tags
			TagController::attachTags($pressRelease, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'editPressRelease', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
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
				// 'building_typology_id' => $details['buildingTypology'],
				'building_use_id' => $details['buildingUse'],
				'image_credits' => $details['imageCredits'],
				'text_credits' => $details['textCredits'],
				'render_credits' => $details['renderCredits'],
				'consultants' => $details['consultants'],
				'design_team' => $details['designTeam'],
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/projects/cover-images', 'project_cover_image'),
				'project_brief' => $details['projectBrief'],
				'project_doc_path' => $details['projectFile'] ? FileController::upload($details['projectFile'], 'documents/projects', 'project_doc') : null,
				'project_doc_link' => $details['projectLink'],
				'photographs_link' => $details['photographsLink'],
				'drawings_link' => $details['drawingsLink'],
			]);
			// create media kit
			MediaKitController::createMediaKit($project, [
				'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
				'audio_video_url' => $details['audioVideoUrl'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
			]);
			// create images (photographs)
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $image){
					ImageController::create($project->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($image, 'images/projects/photographs', 'project_photographs'),
					]);
				}
			}
			// create images (drawings)
			if(count($details['drawingsFiles']) > 0){
				foreach($details['drawingsFiles'] as $image){
					ImageController::create($project->photographs(), [
						'image_type' => 'drawings',
						'image_path' => FileController::upload($image, 'images/projects/drawings', 'project_drawings'),
					]);
				}
			}
			// create tags
			TagController::attachTags($project, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'addProject', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
            return false;
        }
		return true;
	}

	public function editProject(string $mediaKitId, array $details)
	{
		try{
            DB::beginTransaction();

			// find media kit
			$mediaKit = MediaKitController::findById($mediaKitId);
			MediaKitController::isAuthorized($mediaKit);
			$project = $mediaKit->story;
			$slug = $mediaKit->slug;
			if($project->title != $details['projectTitle']){
				$slug = MediaKitController::generateSlug($details['projectTitle']);
			}

			// update media kit
			$mediaKit->update([
				'category_id' => $details['category'],
				'audio_video_url' => $details['audioVideoUrl'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
				'slug' => $slug,
			]);

			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCity'],
			]);

			// update project
			$project->update([
				'title' => $details['projectTitle'],
				'site_area' => $details['siteArea'],
				'site_area_id' => $details['siteAreaUnit'],
				'built_up_area' => $details['builtUpArea'],
				'built_up_area_id' => $details['builtUpAreaUnit'],
				'location_id' => $location->id,
				'project_status_id' => $details['status'],
				'materials' => $details['materials'],
				// 'building_typology_id' => $details['buildingTypology'],
				'building_use_id' => $details['buildingUse'],
				'image_credits' => $details['imageCredits'],
				'text_credits' => $details['textCredits'],
				'render_credits' => $details['renderCredits'],
				'consultants' => $details['consultants'],
				'design_team' => $details['designTeam'],
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/projects/cover-images', 'project_cover_image_edit'),
				'project_brief' => $details['projectBrief'],
				'project_doc_path' => $details['projectFile'] ? FileController::upload($details['projectFile'], 'documents/projects', 'project_doc_edit') : null,
				'project_doc_link' => $details['projectLink'],
				'photographs_link' => $details['photographsLink'],
				'drawings_link' => $details['drawingsLink'],
			]);

			// create images (photographs)
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $image){
					ImageController::create($project->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($image, 'images/projects/photographs', 'project_photographs_edit'),
					]);
				}
			}
			// create images (drawings)
			if(count($details['drawingsFiles']) > 0){
				foreach($details['drawingsFiles'] as $image){
					ImageController::create($project->photographs(), [
						'image_type' => 'drawings',
						'image_path' => FileController::upload($image, 'images/projects/drawings', 'project_drawings_edit'),
					]);
				}
			}
			// update tags
			TagController::attachTags($project, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'editProject', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
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
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/articles/cover-images', 'article_cover_image'),
				'title' => $details['articleTitle'],
				'text_credits' => $details['textCredits'],
				'preview_text' => $details['previewText'],
				'article_doc_path' => $details['articleFile'] ? FileController::upload($details['articleFile'], 'documents/articles', 'article_doc') : null,
				'article_doc_link' => $details['articleLink'],
				'article_writeup' => $details['articleWrite'],
				'company_profile_path' => $details['companyProfileFile'] ? FileController::upload($details['companyProfileFile'], 'documents/articles/company-profiles', 'article_company_profile') : null,
				'company_profile_link' => $details['companyProfileLink'],
				'images_link' => $details['imagesLink'],
			]);
			// create media kit
			// create media kit
			MediaKitController::createMediaKit($article, [
				'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
				'audio_video_url' => $details['audioVideoUrl'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
			]);
			// create images
			if(count($details['imagesFiles']) > 0){
				foreach($details['imagesFiles'] as $image){
					ImageController::create($article->images(), [
						'image_type' => 'images',
						'image_path' => FileController::upload($image, 'images/articles/images', 'article_images'),
					]);
				}
			}
			// create tags
			TagController::attachTags($article, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'addArticle', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
            return false;
        }
		return true;
	}

	public function editArticle(string $mediaKitId, array $details)
	{
		try{
            DB::beginTransaction();

			// find media kit
			$mediaKit = MediaKitController::findById($mediaKitId);
			MediaKitController::isAuthorized($mediaKit);
			$article = $mediaKit->story;
			$slug = $mediaKit->slug;
			if($article->title != $details['articleTitle']){
				$slug = MediaKitController::generateSlug($details['articleTitle']);
			}

			// update media kit
			$mediaKit->update([
				// 'architect_id' => auth()->user()->architect->id,
				'category_id' => $details['category'],
				'audio_video_url' => $details['audioVideoUrl'],
				'media_contact_id' => $details['mediaContact'],
				'project_access_id' => $details['mediaKitAccess'],
				'slug' => $slug,
			]);

			// update article
			$article->update([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/articles/cover-images', 'article_cover_image_edit'),
				'title' => $details['articleTitle'],
				'text_credits' => $details['textCredits'],
				'preview_text' => $details['previewText'],
				'article_doc_path' => $details['articleFile'] ? FileController::upload($details['articleFile'], 'documents/articles', 'article_doc_edit') : null,
				'article_doc_link' => $details['articleLink'],
				'article_writeup' => $details['articleWrite'],
				'company_profile_path' => $details['companyProfileFile'] ? FileController::upload($details['companyProfileFile'], 'documents/articles/company-profiles', 'article_company_profile_edit') : null,
				'company_profile_link' => $details['companyProfileLink'],
				'images_link' => $details['imagesLink'],
			]);

			// create images
			if(count($details['imagesFiles']) > 0){
				foreach($details['imagesFiles'] as $image){
					ImageController::create($article->images(), [
						'image_type' => 'images',
						'image_path' => FileController::upload($image, 'images/articles/images', 'article_images_edit'),
					]);
				}
			}
			// update tags
			TagController::attachTags($article, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			ErrorLogController::logError(
				'editArticle', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
            return false;
        }
		return true;
	}
}
