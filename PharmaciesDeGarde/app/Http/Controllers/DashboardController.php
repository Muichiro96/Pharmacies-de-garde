<?php

namespace App\Http\Controllers;
use App\Models\pharmacie;
use App\Models\User;
use App\Models\garde;
use App\Models\suggestion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    function dashboard(){
        $jourGardePercent=0;
        $nuitGardePercent=0;
        $allDayGardePercent=0;
        $gardesJour=garde::where('type','Jour')->get();
        foreach($gardesJour as $garde){
            $jourGardePercent+=$garde->pharmacies()->count();
        }
        $gardesNuit=garde::where('type','Nuit')->get();
        foreach($gardesNuit as $garde){
            $nuitGardePercent+=$garde->pharmacies()->count();
        }
        $gardesAllDay=garde::where('type','24h/24')->get();
        foreach($gardesAllDay as $garde){
            $allDayGardePercent+=$garde->pharmacies()->count();
        }
        $gardeMonth = [];
        
        for($i=1;$i<=12;$i++){
            $gardes=garde::whereMonth('date',$i)->whereYear('date',date("Y"))->get();
            $gardeChartCount=0;
            if(!empty($gardes)){
            foreach($gardes as $garde){
                
                $gardeChartCount+=$garde->pharmacies->count();
            }}
            $gardeMonth[] = $gardeChartCount;
        }
      
        $userCount=User::count();
        $suggestionCount=suggestion::count();
        $pharmacyCount=pharmacie::count();
        $adminCount=User::where('isAdmin',true)->get()->count();
        $normalUserCount=User::where('isAdmin',false)->get()->count();
        
        $gardeCount=garde::count();
        return view('dashboard.dashboard',compact('userCount','pharmacyCount','gardeCount','suggestionCount','adminCount','normalUserCount','gardeMonth','jourGardePercent','allDayGardePercent','nuitGardePercent'));

    }
}
