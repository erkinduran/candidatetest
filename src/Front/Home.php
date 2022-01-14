<?php
    
    namespace App\Front;
    
    use App\Bags\Calculate;
    
    class Home
    {
        public function index ()
        {
            return view ( "index" );
        }
        
        public function calc ()
        {
            if ( $this->calcValidation () )
            {
                $calc = new Calculate();
                $calc->setBagCost ( $_POST[ "bag_cost" ] );
                $calc->setMeasurement ( $_POST[ "measurement" ] );
                $calc->setDepthMeasurement ( $_POST[ "depth_measurement" ] );
                $calc->setWidth ( $_POST[ "width" ] );
                $calc->setLength ( $_POST[ "length" ] );
                $calc->setDepth ( $_POST[ "depth" ] );
                $result = $calc->calc ();
                
                return r ( $result != FALSE, $result );
            }
            
            return r ( FALSE );
        }
        
        public function calcValidation ()
        {
            if ( isset( $_POST ) )
            {
                if ( !isset( $_POST[ "bag_cost" ] ) ) return FALSE;
                if ( !isset( $_POST[ "measurement" ] ) ) return FALSE;
                if ( !isset( $_POST[ "depth_measurement" ] ) ) return FALSE;
                if ( !isset( $_POST[ "width" ] ) ) return FALSE;
                if ( !isset( $_POST[ "length" ] ) ) return FALSE;
                if ( !isset( $_POST[ "depth" ] ) ) return FALSE;
                
                return TRUE;
            }
            
            return FALSE;
        }
    }