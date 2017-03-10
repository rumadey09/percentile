<?php

namespace ReadFile;

use Cake\Filesystem\File;
## This function is used to read a file
class ReadFile
{
	public function readFile($filePath)
	{		
		$file = new File($filePath, false);
		if($file->exists()) {
		   $results = explode("\n", $file->read());
		   $data = [];
		   foreach ($results as $result)
		   {
			 if($result)
			 {
			   $data[] = utf8_encode(trim($result));
			 }
		   }
		   return $data;
	    } else {
			throw new Exception("File not exist");
	    }
	}
}
?>