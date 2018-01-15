<?php 
class ThairaUploadsImage {
    private $imagePath;
    
    private $width;
    private $height;
    private $type;
    private $mime;
    private $channels;
    private $bits;
    
    public function __construct($path) {
        // Detect GD
        if (! function_exists('imagetypes')) {
            throw new ThairaUploadsException('GD extension is not installed');
        }
        
        // Check file
        if (!is_file($path)) {
            throw new ThairaUploadsException("file $path not exist");
        }
        
        // Check if file is an image
        $filename = basename($path);
        $ext = ThairaUploadsFilePeer::getFilenameExtension($filename);
        if (!ThairaUploadsFilePeer::isImageExtension($ext)) {
            throw new ThairaUploadsException("$path is not an image");
        }
        
        // Retrieve image data
        $data = getimagesize($path);
        if (! $data
				|| ! isset($data[0])
				|| ! isset($data[1])
				|| (isset($data[0]) && $data[0] == 0)
				|| (isset($data[1]) && $data[1] == 0)) {
            throw new ThairaUploadsException("$path is invalid image");
        }
        $this->imagePath = $path;
        $this->width = $data[0];
        $this->height = $data[1];
        $this->type = (isset($data[2]) ? $data[2] : null);
        $this->mime = (isset($data['mime']) ? $data['mime'] : null);
        $this->channels = (isset($data['channels']) ? $data['channels'] : null);
        $this->bits = (isset($data['bits']) ? $data['bits'] : null);
    }
    
    function generateZoomThumbnail($path, $maxWidth, $maxHeight) {
    	// Read the image source
		$image = null;
		switch ($this->type) {
			case IMAGETYPE_PNG:
				$image = @ imagecreatefrompng($this->imagePath);
				break;
			
			case IMAGETYPE_JPEG:
				$image = @ imagecreatefromjpeg($this->imagePath);
				break;
			
			case IMAGETYPE_GIF:
				$image = @ imagecreatefromgif($this->imagePath);
				break;

			default:
				throw new ThairaUploadsException("Unknow image type");
				break;
		}
		
		if (! $image) {
			throw new ThairaUploadsException("Falied to read the image");
		}
		
		// Create the thumbnail target
		$thumb = imagecreatetruecolor($maxWidth, $maxHeight);
		
		// Calc the vertical scaling
		$vs = $maxHeight / $this->height;
		// Check if vertical scaling is the way
		if ($this->width * $vs >= $maxWidth) {
			imagecopyresampled($thumb, $image, 0, 0, ($this->width - $maxWidth / $vs) / 2, 0,
					$maxWidth, $maxHeight,
					$maxWidth / $vs, $this->height);
		} else {
			// Use horizontal scaling
			$hs = $maxWidth / $this->width;
			imagecopyresampled($thumb, $image, 0, 0, 0, ($this->height - $maxHeight / $hs) / 2,
					$maxWidth, $maxHeight,
					$this->width, $maxHeight / $hs);
		}
		
		// Write the tumbnail image
		switch ($this->type) {
			case IMAGETYPE_PNG:
				$r = @ imagepng($thumb, $path);
				break;
			
			case IMAGETYPE_JPEG:
				$r = @ imagejpeg($thumb, $path);
				break;
			
			case IMAGETYPE_GIF:
				$r = @ imagegif($thumb, $path);
				break;
		}
		
		imagedestroy($image);
		imagedestroy($thumb);
		
		if (! $r) {
			throw new ThairaUploadsException("Falied to write the thumbnail");
		}
    }
}
