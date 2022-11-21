<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Car;
use App\Models\Customer;
use App\Models\CarModel;
use App\Models\Brand;
use App\Models\ScheduledMaintenanceJob;
use App\Models\Timeslot;
use App\Models\Engineer;
use App\Models\MaintenanceJob;
use App\Models\SparePart;

class Pricing extends Model
{
  public static function getParts(string $carLicense, string $startDate)
  {
    $result = [];

    // validate params
    if (!empty($carLicense) && !empty($startDate))
    {
      // retrieve car data from model (database table) equals license input
      $car = Car::where('car_license', $carLicense)->first();
      // retrieve customer and optional carModel data linked to car
      if ($car) {
        $customer = $car->customer;
        $carModel = $car->carmodel;
        // Only if carModel has data, proceed to retrieve spareparts else no parts of this car model available
        if ($carModel) {
          // retrieve brand data according to carModel
          $brand = $carModel->brand;
          // retrieve 1 scheduledmaitenancejob (SMJ) according to the car->id and if a timeslot is linked
          $schedMaintJob = Schedmaintjob::whereHas('timeslots', function($q) use ($startDate) {
            $q->where('start_date', '=', $startDate);
          })->where('car_id', '=', $car->id)->first();
          if ($schedMaintJob) {
            // retrieve engineer and maintenancejob data for a found SMJ
            $engineer = $schedMaintJob->engineer;
            $maintJob = $schedMaintJob->maintjob;
            // retrieve spareparts for maintenancejob
            $spareParts = $maintJob->spareparts;
            // return spareparts et al
            $result = [
              'parts' => $spareParts,
              'car' => $car,
              'customer' => $customer,
              'engineer' => $engineer,
            ];
          } else {
            $result['Error'] = 'No scheduled maintenance job found!';
          }
        } else {
          $result['Error'] = 'Carmodel unknown, no parts available!';
        }
      } else {
        $result['Error'] = 'No car found!';
      }
    } else {
      $result['Error'] = 'No car license or startdate given!';
    }

    return $result;
  }
}