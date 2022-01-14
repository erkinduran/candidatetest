<?php
    
    namespace App\Front;
    
    use App\Bags\Calculate;
    use App\Core\DB;

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
    
                DB::insert("
                    INSERT INTO calculations (
                        bag_cost,
                        measurement,
                        depth_measurement,
                        width,
                        length,
                        depth,
                        bags_of_top_soil,
                        total_cost,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        {$_POST[ "bag_cost" ]},
                        '{$_POST[ "measurement" ]}',
                        '{$_POST[ "depth_measurement" ]}',
                        {$_POST[ "width" ]},
                        {$_POST[ "length" ]},
                        {$_POST[ "depth" ]},
                        {$result->bagsOfTopSoil},
                        {$result->totalCost},
                        NOW(),
                        NOW()
                    )
                ");
                
                return r ( $result != FALSE, $result );
            }
            
            return r ( FALSE );
        }
    
        public function getCalculations ()
        {
            $sth = DB::select ( 'SELECT * FROM calculations' );
            
            return r($sth,$sth->fetchAll(\PDO::FETCH_ASSOC));
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