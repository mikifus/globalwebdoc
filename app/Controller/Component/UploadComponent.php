<?
/*************************************************** 
* Upload Component 
* 
* Manages uploaded files to be saved to the file system. 
* 
* @author       Tim Joyce
* @company      Thoughtwire media
* @version      1.0.1
*
* PARAMS *
*
$this->Upload->uploadFile(
    array(
        'filepath' => 'c:\wamp\www\myapp\webroot\\',                        //USE THIS PATH FOR LOCALHOST | CHANGE TO RELATIVE PATH WHEN APP GOES LIVE
        'directory' => $this->Auth->user('id'),                             //INIT THIS INDEX IF YOU ARE CREATING USER/SPECIFIC FOLDERS THAT CONTAIN THEIR FILES
        'tmp_filename' => $this->data['Image']['filename']['tmp_name'],     //MODEL[Image] | FORM FIELD NAME['filename'] | DO NOT CHANGE['tmp_name']
        'target_filename' => $this->data['Image']['filename']['name']       //MODEL[Image] | FORM FIELD NAME['filename'] | DO NOT CHANGE['name']
    )
);
*
***************************************************/
 
class UploadComponent extends Object{

	function initialize(){
// 		parent::initialize();
	}
	function startup(){
// 		parent::initialize();
	}
	function beforeRender(){
// 		parent::initialize();
	}
	function beforeRedirect(){
// 		parent::initialize();
	}
	function shutdown(){
// 		parent::initialize();
	}
 
    function uploadFile($fileAttributes){
        //CHANGE THE FOLLOWING 2 VARS FOR CUSTOM SETTINGS 
        $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // ALLOWED FILE TYPES.
        $max_filesize = 16777216; // MAX FILESIZE IN BYTES [2mb].
         
        $filename = $fileAttributes['target_filename']; 
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); 
        $base_dir = $fileAttributes['filepath']; 
        $tmp_filename = $fileAttributes['tmp_filename']; 
        $target_filename = $fileAttributes['target_filename'];
        $final_target_path = $fileAttributes['filepath'] . "/";
         
        if(!in_array($ext,$allowed_filetypes)) {
          return 'The file you attempted to upload is not allowed.';
        }
           
        if(filesize($fileAttributes['tmp_filename']) > $max_filesize){
            return 'The file you attempted to upload is too large.';  
        }
         
        if(isset($fileAttributes['directory'])){
            $build_directory = $fileAttributes['directory'];
            $build_directory = ROOT.DS.APP_DIR.DS.$base_dir.DS.$build_directory;
            $final_target_path = $build_directory.DS;
            $this -> mkdir($build_directory);
        }
        $final_target_path = $final_target_path.$target_filename;
         
        if(move_uploaded_file($tmp_filename, $final_target_path)) {
             return 'true';
        } else {
             return "There was an error during your file upload";
        }
    }
    
    function mkdir($directory) {
        if(!file_exists($directory)){
            $directory = str_replace(ROOT, '', $directory);
            $array_directory = explode(DS, $directory);
            $dir = ROOT;
            foreach ($array_directory as $d) {
                $dir = $dir . DS . $d;
                if(!file_exists($dir)){
                    if(!mkdir($dir, 0755)) {
                        return 'There was a problem with the upload destination.';
                    }
                }
            }
        }
    }
}