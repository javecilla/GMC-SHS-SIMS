<?php

namespace App\Helpers;

use Carbon\Carbon;

class ScheduleHelper
{
  public static function generateStudentAppointment(?string $dateRegistered = null): string
  {
    //convert the string dateRegistered into carbon object
    $dateRegistered = Carbon::parse($dateRegistered);
    // If no date registered is provided, use current date
    $dateRegistered = $dateRegistered ?? Carbon::now();
    // Start date will be 2 days after registration date
    $startDate = $dateRegistered->copy()->addDays(2)->startOfDay();
    // Ensure start date is not a Sunday
    if ($startDate->dayOfWeek === Carbon::SUNDAY) {
      $startDate->addDay();
    }
    // End date will be 2 weeks from the start date
    $endDate = $startDate->copy()->addWeeks(2)->endOfDay();
    $timeSlots = [
      '7:30 AM to 5:30 PM',
      '8:00 AM to 3:00 PM',
      '8:30 AM to 3:30 PM',
      '10:00 AM to 4:00 PM',
      '9:00 AM to 2:00 PM'
    ];

    $schedules = [];
    // Clone the start date to avoid modifying the original
    $currentDate = $startDate->copy();
    // Continue until we reach or exceed the end date
    while ($currentDate->lte($endDate)) {
      // Skip Sundays
      if ($currentDate->dayOfWeek !== Carbon::SUNDAY) {
        // Randomly select a time slot for the day
        $timeSlot = $timeSlots[array_rand($timeSlots)];
        // Format the schedule string
        $scheduleString = sprintf(
          '%s (%s) - %s',
          $currentDate->format('F j, Y'),
          $currentDate->format('l'),
          $timeSlot
        );

        $schedules[] = $scheduleString;
      }

      // Move to the next day
      $currentDate->addDay();
    }

    // Select a random schedule
    $ri = array_rand($schedules);
    $appointedSchedule = $schedules[$ri];

    return $appointedSchedule;
  }
}