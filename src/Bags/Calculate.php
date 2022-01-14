<?php
    
    namespace App\Bags;
    
    class Calculate
    {
        public $measure;
        public $depthMeasurement;
        public $dimension;
        
        public function setMeasurement ( $measure )
        {
            $this->measure = $measure;
        }
        
        public function setDepthMeasurement ( $depthMeasurement )
        {
            $this->depthMeasurement = $depthMeasurement;
        }
        
        public function setDimension ( $dimension )
        {
            $this->dimension = $dimension;
        }
        
        public function calc ()
        {
        
        }
        
        public function save ()
        {
        
        }
    }