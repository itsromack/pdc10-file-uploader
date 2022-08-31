<?php

class File
{
	protected $id;
	protected $label;
	protected $filename;
	protected $path;
	protected $type;

	const DIRECTORY_DOCUMENTS = 'documents/';
	const DIRECTORY_IMAGES = 'images/';

	public function __construct(
		$label,
		$path = null,
		$type = null
	)
	{
		$this->label = $label;
		$this->path = $path;
		$this->type = $type;
	}

	public function getFilename()
	{
		return $this->filename;
	}

	public function getpath()
	{
		return $this->path;
	}

	public function getType()
	{
		return $this->type;
	}

	public function save()
	{
		//
	}

	public static function handleUpload($fileObject)
	{
		try {
			$base_dir = getcwd() . '/';
			$target_dir = $base_dir . static::DIRECTORY_DOCUMENTS;

			$check = getimagesize($fileObject['tmp_name']);
			if ($check !== false) {
				$target_dir = $base_dir . static::DIRECTORY_IMAGES;
			}

			if (is_uploaded_file($fileObject['tmp_name'])) {
				$target_file_path = $target_dir . $fileObject['name'];
				if (move_uploaded_file($fileObject['tmp_name'], $target_file_path)) {
					return $target_file_path;
				}
			}
		} catch (Exception $e) {
			error_log($e->getMessage());
			return false;
		}
	}
}