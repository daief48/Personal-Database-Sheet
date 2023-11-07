<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            
            $table->id();

               //A. Personal Information

               $table->string('full_name');
               $table->string('short_name');
               $table->string('sex');
               $table->string('official_designation');
               $table->string('represented_organization');
               $table->string('mailing_address');
               $table->string('country');
               $table->string('telephone');
               $table->string('cell_phone');
               $table->string('fax');
               $table->string('email');
               $table->string('website');
   
           //EMERGENCY CONTACT DETAILS::
   
               $table->string('emergency_name');
               $table->string('emergency_relationship');
               $table->string('emergency_email');
               $table->string('emergency_phone');
   
           //B. DISABILITY RELATED INFORMATION:
   
               $table->string('type_of_disability');
               $table->string('aids_or_assistive_devices');
               $table->string('require_assistance');
               $table->string('accompanied_by_attendant');
               $table->string('disabled_person_name');
               $table->string('disabled_person_sex');
               
               //C. HEALTH RELATED INFORMATION:
   
               $table->string('health_or_medical_condition');
   
           //D. FOOD/DIET RELATED INFORMATION:
   
               $table->string('food_preference');
               $table->string('food_restrictions');
               $table->string('food_allergies');
   
           //E. ACCOMMODATION RELATED INFORMATION (FOR OVERSEAS PARTICIPANTS ONLY):
   
               $table->string('arrange_accommodation');
               $table->string('shared_room');
   
           //F. LANGUAGE RELATED INFORMATION (FOR OVERSEAS PARTICIPANTS):
   
               $table->string('interpretation');
               $table->string('interpretation_language');
   
           //H. PASSPORT RELATED INFORMATION (FOR OVERSEAS PARTICIPANTS):
   
               $table->string('name_passport');
               $table->string('nationality');
               $table->string('place_of_birth');
               $table->string('passport_number');
               $table->string('place_of_issue');
               $table->string('date_of_issue');
               $table->string('date_of_expiry');
   
           //(Passport related information of personal attendant of overseas participant with disabilities)   
               $table->string('attendant_name_passport');
               $table->string('attendant_nationality');
               $table->string('attendant_place_of_birth');
               $table->string('attendant_passport_number');
               $table->string('attendant_place_of_issue');
               $table->string('attendant_date_of_issue');
               $table->string('attendant_date_of_expiry');
         
               //I. PAYMENT RELATED INFORMATION (PLEASE TICK):
   
               $table->string('payment_mode');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};
