<?php

require 'models/om/BasePicsPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'pics' table.
 *
 * Pictures of celebrities
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class PicsPeer extends BasePicsPeer {

    /**
     * Processes a celebrity's picture that has been uploaded to the system and returns a Pics object.
     *
     * The function will handle the process of choosing a name, scaling and copying the uploaded
     * picture, deleting of any temporary files and the creating and saving of a Pics instance.
     *
     * @param unknown_type $file
     * @param unknown_type $picsPath
     * @param Names $celeb
     */
    public static function process_new_picture($file, Names $celeb){
        global $appConf;
        
        /* Find the next picture file name based on the current time */
        $picName = time();
        $picName -= mktime(0, 0, 0, 1, 1, 2007);  // Midnight, Jan 1 2007
        // Make sure we got a picture file
        $ext = strtolower(end(explode('.',$file["name"])));
        if ($ext != 'gif' && $ext != 'jpg' && $ext != 'jpeg' && $ext != 'png'){
            throw new Exception('All uploaded pictures must be of the following types: gif, jpg, jpeg, png.', 10);
        }
        $picName .= "." . $ext; 
        $fullName = Pics::fullPrefix . $picName;
        $thumbName = Pics::thumbPrefix . $picName;
        $tempPath = $appConf['pics_path'] . $picName;
        $fullPath = $appConf['pics_path'] . $fullName;
        $thumbPath = $appConf['pics_path'] . $thumbName;
    
        try{
            // Move the picture
            if(!@move_uploaded_file($file['tmp_name'], $tempPath))
                throw new boris_MinorException('An error occured while moving the temporary picture - ' . $php_errormsg);
                
            // Scale the images
            $return_var;
            system("convert -antialias -sample 300x400 $tempPath $fullPath", $return_var);
            if ($return_var != 0) 
                throw new boris_MinorException('An error occured while creating the full version of the picture - ' . $return_var);
            system("convert -antialias -sample 120x160 $tempPath $thumbPath", $return_var);
            if ($return_var != 0) 
                throw new boris_MinorException('An error occured while creating the thumb version of the picture - ' . $return_var);
                
            // Delete the temp Picture
            if (!@unlink($tempPath))
                throw new boris_MinorException('An error occured while removing the temporary picture - ' . $php_errormsg);
                
            // Create new database entry
            $pic = new Pics();
            $pic->setPic($picName);
            $pic->setNames($celeb);
            $pic->save();
        } catch (Exception $e){
            // Try to undo things
            if (file_exists($fullPath)) @unlink($fullPath);
            if (file_exists($thumbPath)) @unlink($thumbPath);
            if (file_exists($tempPath)) @unlink($tempPath);
            
            if ($e instanceof boris_MinorException){
                echo 'An exception has been thrown:<br/>';
                echo 'Messaeg: ' . $e->getMessage() . '<br/>';
                echo 'File: ' . $e->getFile() . '<br/>';
                echo 'Line: ' . $e->getLine() . '<br/>';
                echo 'Trace: ' . $e->getTraceAsString() . '<br/>';
            } else {
                throw $e;
            }
        }
    }
    
    /**
     * Delete a picture based on the base portion of its filename
     *
     * @param unknown_type $base_filename
     * @param Names $celeb
     */
    public static function remove_picture($base_filename, Names $celeb){
        $pic = PicsPeer::retrieveByPK($celeb->getId(), $base_filename);
        
        // Delete the pictures
        PicsPeer::delete_picture_fs($pic);
            
        PicsPeer::doDelete($pic);
    }
    
    /**
     * Deletes the image files from the file system that are associated with the provided
     * Pics instance.
     *
     * @param Pics $pic
     */
    public static function delete_picture_fs(Pics $pic){
        global $appConf;
        if (!@unlink($appConf['pics_path'].$pic->getPic()))
            throw new Exception('An error occured while deleting ' . $pic->getPic() . ' - ' . $php_errormsg, 10);
        if (!@unlink($appConf['pics_path'].$pic->getThumbnail()))
            throw new Exception('An error occured while deleting ' . $pic->getThumbnail() . ' - ' . $php_errormsg, 10);
    }
} // PicsPeer
