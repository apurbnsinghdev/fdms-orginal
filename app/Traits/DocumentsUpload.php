<?php

namespace App\Traits;
use App\Document;
//use Intervention\Image\Facades\Image;

trait DocumentsUpload {
	public function storeDucuments($fieldsArr, $insertedObj, $module_name = null, $oldFieldsArr = []) {
		if (is_array($fieldsArr)) {
			$docData = [];
			$fileNameArr = [];
			$i = 0;
			if ($module_name) {
				foreach ($fieldsArr as $key => $value) {
					$docData[$i]['shop_id'] = $insertedObj->shop_id;
					$docData[$i]['data_id'] = $insertedObj->id;
					$docData[$i]['module'] = $module_name;
					$docData[$i]['field_name'] = $key;
					$fileName = time() . '_' . $key . '.' . $value->getClientOriginalExtension();
					$docData[$i]['file_name'] = $fileName;
					$fileNameArr[$fileName] = $value;
					$docData[$i]['created_at'] = \Carbon\Carbon::now();
					$docData[$i]['updated_at'] = \Carbon\Carbon::now();
					if (array_key_exists('old_' . $key, $oldFieldsArr)) {
						Document::where('data_id', $insertedObj->id)
							->where('file_name', $oldFieldsArr['old_' . $key])
							->where('module', $module_name)
							->delete();
						\Storage::delete('images' . DIRECTORY_SEPARATOR . $insertedObj->shop_id . DIRECTORY_SEPARATOR . $oldFieldsArr['old_' . $key]);
					}
					$i++;
				}
			} else {
				foreach ($fieldsArr as $key => $value) {
					$docData[$i]['shop_id'] = $insertedObj->id;
					$docData[$i]['field_name'] = $key;
					$fileName = time() . '_' . $key . '.' . $value->getClientOriginalExtension();
					$docData[$i]['file_name'] = $fileName;
					$fileNameArr[$fileName] = $value;
					$docData[$i]['created_at'] = \Carbon\Carbon::now();
					$docData[$i]['updated_at'] = \Carbon\Carbon::now();
					if (array_key_exists('old_' . $key, $oldFieldsArr)) {
						Document::where('file_name', $oldFieldsArr['old_' . $key])
							->whereNull('module')
							->delete();
						\Storage::delete('images' . DIRECTORY_SEPARATOR . $insertedObj->id . DIRECTORY_SEPARATOR . $oldFieldsArr['old_' . $key]);
					}
					$i++;
				}
			}
			if (count($docData)) {
				$documents = Document::insert($docData);
				if ($documents) {
					if ($module_name) {
						$shopId = $insertedObj->shop_id;
					} else {
						$shopId = $insertedObj->id;
					}
					foreach ($fileNameArr as $ke => $val) {
						// $ext = pathinfo($ke, PATHINFO_EXTENSION);
						// if (strtolower($ext) == 'pdf') {
						// 	$val->storeAs('images/' . $shopId, $ke);
						// } else {
						// 	$directory = '../public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $shopId . DIRECTORY_SEPARATOR;
						// 	\Storage::makeDirectory('images' . DIRECTORY_SEPARATOR . $shopId . DIRECTORY_SEPARATOR);
						// 	$imageUrl = $directory . $ke;
						// 	Image::make($val)->resize(300, 300)->save($imageUrl);
						// }
						$val->storeAs('images/' . $shopId, $ke);

					}
				}
			}
		}
		return true;
	}
}
