<?php
    
    namespace App\Bags;
    
    class Calculate
    {
        public $bag_cost         = NULL;
        public $measure          = NULL;
        public $depthMeasurement = NULL;
        public $width            = NULL;
        public $length           = NULL;
        public $depth            = NULL;
        
        public function setBagCost ( $bag_cost )
        {
            $this->bag_cost = $bag_cost;
        }
        
        public function setMeasurement ( $measure )
        {
            $this->measure = $measure;
        }
        
        public function setDepthMeasurement ( $depthMeasurement )
        {
            $this->depthMeasurement = $depthMeasurement;
        }
        
        public function setWidth ( $width )
        {
            $this->width = $width;
        }
        
        public function setLength ( $length )
        {
            $this->length = $length;
        }
        
        public function setDepth ( $depth )
        {
            $this->depth = $depth;
        }
        
        public function calc ()
        {
            if ( $this->calcValidate () )
            {
                $metressquared         = $this->width * $this->length;
                $depth                 = $this->depth / 100;
                $cubicmeters           = $metressquared * $depth;
                $halfCalc              = $cubicmeters * 1.4;
                $bagsOfTopSoil         = round ( $halfCalc );
                $result                = new \stdClass();
                $result->bagsOfTopSoil = $bagsOfTopSoil;
                $result->totalCost     = $bagsOfTopSoil * $this->bag_cost;
                
                return $result;
            }
            
            return FALSE;
        }
        
        public function calcValidate ()
        {
            if ( $this->bag_cost == NULL ) return FALSE;
            if ( $this->measure == NULL ) return FALSE;
            if ( $this->depthMeasurement == NULL ) return FALSE;
            if ( $this->width == NULL ) return FALSE;
            if ( $this->length == NULL ) return FALSE;
            if ( $this->depth == NULL ) return FALSE;
            
            return TRUE;
        }
    }