
@push('country-dropdown')
         <!-- link for jquery style -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
         <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
   
         <script src="{{asset('country-dropdown/assets/js/geodatasource-cr.min.js')}}"></script>
         <link rel="stylesheet" href="{{asset('country-dropdown/assets/css/geodatasource-countryflag.css')}}">
       
 
         <!-- link to eng language po file -->
         @if(Lang::locale()=='ar')
         <link rel="gettext" type="application/x-po" href="{{asset('country-dropdown/languages/ar/LC_MESSAGES/ar.txt')}}" />
             
         @else
         <link rel="gettext" type="application/x-po" href="{{asset('country-dropdown/languages/en/LC_MESSAGES/en.txt')}}" />
             
         @endif
         <script type="text/javascript" src="{{asset('country-dropdown/assets/js/Gettext.js')}}"></script>
        
 
         <script type="text/javascript">
             $(document).ready(function() {
                 $("#gds-cr-one").on('change',function() {
                    
                     jQuery("#country_h").val($("#countrySelection").children("option").filter(":selected").text());
                     jQuery("#region_h").val($(this).children("option").filter(":selected").text());
                 });
             });
         </script>
   
@endpush
   
  
<?php
$country = $region = '';
if (isset( $_POST["country_h"])) {
    $country = $_POST["country_h"];
    $region = $_POST["region_h"];
}
 ?>


                        <div class="form-group gds-cr-one">
                            <label for="gds-cr-one" class="col-sm-2 control-label">{{__('validation.attributes.frontend.region')}}</label>
                           
                            <div class="col-sm-10">
                                @if(Lang::locale()=='ar')
                                <select name="city" class="form-control" id="gds-cr-one" region-data-default-value="{{$logged_in_user?$logged_in_user->city:''}}" data-language="ar"></select>
                           @else
                           <select name="city" class="form-control" id="gds-cr-one" region-data-default-value="{{$logged_in_user?$logged_in_user->city:''}}" data-language="en"></select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group countrySelection">
                            <label class="col-sm-2 control-label">{{__('validation.attributes.frontend.country')}}</label>
                            <div class="col-sm-10">
                                @if(Lang::locale()=='ar')
                                <select onchange="checkNationality(e)" name="country" id="countrySelection" class="form-control gds-cr" country-data-region-id="gds-cr-one" country-data-default-value="{{$logged_in_user?$logged_in_user->country:''}}" data-language="ar"></select>
                               @else
                                <select onchange="checkNationality(e)" name="country" id="countrySelection" class="form-control gds-cr" country-data-region-id="gds-cr-one" country-data-default-value="{{$logged_in_user?$logged_in_user->country:''}}" data-language="en"></select>
                            @endif
                            </div>
                        </div>
                        <div style="text-align:center">
                            <input type="hidden" name="country_h" id="country_h" value="<?php echo $country; ?>">
                            <input type="hidden" name="region_h" id="region_h" value="<?php echo $region; ?>">
                            
                        </div>
                   

                  
                 

               
         