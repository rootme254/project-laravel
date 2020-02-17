<?php
namespace App\CustomHelpers\User;
use App\Landlord;
use Carbon\Carbon;

class LandlordFilter
{
    /**
    * Get Landlords ordered based on supplied filters.
    *
    * @param   $sortField and $orderBy
    * @return  $Landlords
    */
    public static function getLandlordsByOrder( $filters = [] )
    {
       $sortField = 'id';

        if( isset($filters['sortField']) )
          {
            $sortField = $filters['sortField'];

            return Landlord::orderBy( $sortField)->get();
            
          }
        /*
        * did it this way coz there were no other criterie for filtering except 
        with the id ,ie in migrations only id and timestamp
        */
            return Landlord::all();
     }

    /**
     * Get Landlords created on a certain date.
     *
     * @param   $date
     * @return  $Landlords
     */
    public static function getLandlordsByDate( $date = null )
    {
      if( $date )

        return Landlord::whereDate('created_at',$date)->get();

      else

        return Landlord::all();
    
    }

    /**
      * Get Landlords created during specific dates.
      *
      * @param   $startDate and $endDate
      * @return  $Landlords
      */
      public static function getLandlordsBySpecificDate( $filters = [] )
      {
          $startDate = null;
          $endDate = null;
          $sortDateField = 'created_at';
          $operandA = '<>';
          $operandB = '<>';

          if( isset($filters['startDate']) && isset($filters['endDate']) )
          {
            $startDate = $filters['startDate'];
            $endDate = $filters['endDate'];
            $operandA = '>=';
            $operandB = '<=';
          }
 
          elseif( !isset($filters['startDate']) && isset($filters['endDate']) )
          {
            $endDate = $filters['endDate'];
            $operandB = '<=';
          }
 
 
          elseif( isset($filters['startDate']) && !isset($filters['endDate']) )
          {
            $startDate = $filters['startDate'];
            $operandA = '>=';
          }
 


        return Landlord::whereDate( $sortDateField,$operandA,$startDate )->whereDate( $sortDateField,$operandB,$endDate )->get();
      }  
          
      }  

}
