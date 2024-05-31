@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Forms</a></li>
            <li><a>Advanced</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
    <!--MAX LENGTH-->
    <div class="col-sm-6">
        <h4 class="section-subtitle"><b>Max Length</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="">
                            <!--INPUT max length-->
                            <div class="form-group">
                                <label for="inputMaxLength" class="control-label">Input</label>
                                <input type="text" class="form-control" id="inputMaxLength" placeholder="Username" maxlength="20">
                                <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">20</span></span>
                            </div>
                            <!--TEXTAREA max length-->
                            <div class="form-group">
                                <label for="textareaMaxLength" class="control-label">Textarea</label>
                                <textarea class="form-control" rows="3" id="textareaMaxLength" placeholder="Write a comment" maxlength="100"></textarea>
                                <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">100</span></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--INPUT MASK-->
    <div class="col-sm-6">
        <h4 class="section-subtitle"><b>Input Mask</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form>
                            <!--DATE mask-->
                            <div class="form-group">
                                <div class="input-group mt-sm mb-sm">
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="text" class="form-control" id="date-mask" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <!--CURRENCY mask-->
                            <div class="form-group">
                                <div class="input-group mb-sm">
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    <input type="text" class="form-control" id="currency-mask">
                                </div>
                            </div>
                            <!--LICENSE CAR mask-->
                            <div class="form-group">
                                <div class="input-group mb-sm">
                                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                    <input type="text" class="form-control" id="license-mask" placeholder="[9]-AAA-999">
                                </div>
                            </div>
                            <!--PHONE mask-->
                            <div class="form-group">
                                <label for="phone-mask">Country: <span id="country-name">Germany</span></label>
                                <div class="input-group mb-sm">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone-mask" value="49">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--SELECTS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Searching & Tags Selects</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--BASIC-->
                            <div class="form-group">
                                <label for="select2-example-basic" class="col-sm-2 control-label">Basic</label>
                                <div class="col-sm-10">
                                    <select name="country" id="select2-example-basic" class="form-control" style="width: 100%">
                                        <optgroup label="AMERICA">
                                            <option value="AI" label="Anguilla">Anguilla</option>
                                            <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="AR" label="Argentina">Argentina</option>
                                            <option value="AW" label="Aruba">Aruba</option>
                                            <option value="BS" label="Bahamas">Bahamas</option>
                                            <option value="BB" label="Barbados">Barbados</option>
                                            <option value="BZ" label="Belize">Belize</option>
                                            <option value="BM" label="Bermuda">Bermuda</option>
                                            <option value="BO" label="Bolivia">Bolivia</option>
                                            <option value="BR" label="Brazil">Brazil</option>
                                            <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                            <option value="CA" label="Canada">Canada</option>
                                            <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                            <option value="CL" label="Chile">Chile</option>
                                            <option value="CO" label="Colombia">Colombia</option>
                                            <option value="CR" label="Costa Rica">Costa Rica</option>
                                            <option value="CU" label="Cuba">Cuba</option>
                                            <option value="DM" label="Dominica">Dominica</option>
                                            <option value="DO" label="Dominican Republic">Dominican Republic</option>
                                            <option value="EC" label="Ecuador">Ecuador</option>
                                            <option value="SV" label="El Salvador">El Salvador</option>
                                            <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                            <option value="GF" label="French Guiana">French Guiana</option>
                                            <option value="GL" label="Greenland">Greenland</option>
                                            <option value="GD" label="Grenada">Grenada</option>
                                            <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                            <option value="GT" label="Guatemala">Guatemala</option>
                                            <option value="GY" label="Guyana">Guyana</option>
                                            <option value="HT" label="Haiti">Haiti</option>
                                            <option value="HN" label="Honduras">Honduras</option>
                                            <option value="JM" label="Jamaica">Jamaica</option>
                                            <option value="MQ" label="Martinique">Martinique</option>
                                            <option value="MX" label="Mexico">Mexico</option>
                                            <option value="MS" label="Montserrat">Montserrat</option>
                                            <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="NI" label="Nicaragua">Nicaragua</option>
                                            <option value="PA" label="Panama">Panama</option>
                                            <option value="PY" label="Paraguay">Paraguay</option>
                                            <option value="PE" label="Peru">Peru</option>
                                            <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                            <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                            <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                            <option value="MF" label="Saint Martin">Saint Martin</option>
                                            <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="SR" label="Suriname">Suriname</option>
                                            <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option value="US" label="United States">United States</option>
                                            <option value="UY" label="Uruguay">Uruguay</option>
                                            <option value="VE" label="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="ASIA">
                                            <option value="AF" label="Afghanistan">Afghanistan</option>
                                            <option value="AM" label="Armenia">Armenia</option>
                                            <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                            <option value="BH" label="Bahrain">Bahrain</option>
                                            <option value="BD" label="Bangladesh">Bangladesh</option>
                                            <option value="BT" label="Bhutan">Bhutan</option>
                                            <option value="BN" label="Brunei">Brunei</option>
                                            <option value="KH" label="Cambodia">Cambodia</option>
                                            <option value="CN" label="China">China</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="GE" label="Georgia">Georgia</option>
                                            <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                            <option value="IN" label="India">India</option>
                                            <option value="ID" label="Indonesia">Indonesia</option>
                                            <option value="IR" label="Iran">Iran</option>
                                            <option value="IQ" label="Iraq">Iraq</option>
                                            <option value="IL" label="Israel">Israel</option>
                                            <option value="JP" label="Japan">Japan</option>
                                            <option value="JO" label="Jordan">Jordan</option>
                                            <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                            <option value="KW" label="Kuwait">Kuwait</option>
                                            <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="LA" label="Laos">Laos</option>
                                            <option value="LB" label="Lebanon">Lebanon</option>
                                            <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                            <option value="MY" label="Malaysia">Malaysia</option>
                                            <option value="MV" label="Maldives">Maldives</option>
                                            <option value="MN" label="Mongolia">Mongolia</option>
                                            <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                            <option value="NP" label="Nepal">Nepal</option>
                                            <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                            <option value="KP" label="North Korea">North Korea</option>
                                            <option value="OM" label="Oman">Oman</option>
                                            <option value="PK" label="Pakistan">Pakistan</option>
                                            <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                            <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                            <option value="PH" label="Philippines">Philippines</option>
                                            <option value="QA" label="Qatar">Qatar</option>
                                            <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                            <option value="SG" label="Singapore">Singapore</option>
                                            <option value="KR" label="South Korea">South Korea</option>
                                            <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                            <option value="SY" label="Syria">Syria</option>
                                            <option value="TW" label="Taiwan">Taiwan</option>
                                            <option value="TJ" label="Tajikistan">Tajikistan</option>
                                            <option value="TH" label="Thailand">Thailand</option>
                                            <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                            <option value="TR" label="Turkey">Turkey</option>
                                            <option value="™" label="Turkmenistan">Turkmenistan</option>
                                            <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                            <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                            <option value="VN" label="Vietnam">Vietnam</option>
                                            <option value="YE" label="Yemen">Yemen</option>
                                        </optgroup>
                                        <optgroup label="EUROPE">
                                            <option value="AL" label="Albania">Albania</option>
                                            <option value="AD" label="Andorra">Andorra</option>
                                            <option value="AT" label="Austria">Austria</option>
                                            <option value="BY" label="Belarus">Belarus</option>
                                            <option value="BE" label="Belgium">Belgium</option>
                                            <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="BG" label="Bulgaria">Bulgaria</option>
                                            <option value="HR" label="Croatia">Croatia</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="CZ" label="Czech Republic">Czech Republic</option>
                                            <option value="DK" label="Denmark">Denmark</option>
                                            <option value="DD" label="East Germany">East Germany</option>
                                            <option value="EE" label="Estonia">Estonia</option>
                                            <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                            <option value="FI" label="Finland">Finland</option>
                                            <option value="FR" label="France">France</option>
                                            <option value="DE" label="Germany">Germany</option>
                                            <option value="GI" label="Gibraltar">Gibraltar</option>
                                            <option value="GR" label="Greece">Greece</option>
                                            <option value="GG" label="Guernsey">Guernsey</option>
                                            <option value="HU" label="Hungary">Hungary</option>
                                            <option value="IS" label="Iceland">Iceland</option>
                                            <option value="IE" label="Ireland">Ireland</option>
                                            <option value="IM" label="Isle of Man">Isle of Man</option>
                                            <option value="IT" label="Italy">Italy</option>
                                            <option value="JE" label="Jersey">Jersey</option>
                                            <option value="LV" label="Latvia">Latvia</option>
                                            <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                            <option value="LT" label="Lithuania">Lithuania</option>
                                            <option value="LU" label="Luxembourg">Luxembourg</option>
                                            <option value="MK" label="Macedonia">Macedonia</option>
                                            <option value="MT" label="Malta">Malta</option>
                                            <option value="FX" label="Metropolitan France">Metropolitan France</option>
                                            <option value="MD" label="Moldova">Moldova</option>
                                            <option value="MC" label="Monaco">Monaco</option>
                                            <option value="ME" label="Montenegro">Montenegro</option>
                                            <option value="NL" label="Netherlands">Netherlands</option>
                                            <option value="NO" label="Norway">Norway</option>
                                            <option value="PL" label="Poland">Poland</option>
                                            <option value="PT" label="Portugal">Portugal</option>
                                            <option value="RO" label="Romania">Romania</option>
                                            <option value="RU" label="Russia">Russia</option>
                                            <option value="SM" label="San Marino">San Marino</option>
                                            <option value="RS" label="Serbia">Serbia</option>
                                            <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="SK" label="Slovakia">Slovakia</option>
                                            <option value="SI" label="Slovenia">Slovenia</option>
                                            <option value="ES" label="Spain">Spain</option>
                                            <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="SE" label="Sweden">Sweden</option>
                                            <option value="CH" label="Switzerland">Switzerland</option>
                                            <option value="UA" label="Ukraine">Ukraine</option>
                                            <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                            <option value="GB" label="United Kingdom">United Kingdom</option>
                                            <option value="VA" label="Vatican City">Vatican City</option>
                                            <option value="AX" label="Åland Islands">Åland Islands</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <!--MULTIPLE-->
                            <div class="form-group">
                                <label for="select2-example-multiple" class="col-sm-2 control-label">Multiple</label>
                                <div class="col-sm-10">
                                    <select name="country" id="select2-example-multiple" class="form-control" multiple="multiple" style="width: 100%">
                                        <optgroup label="AMERICA">
                                            <option value="AI" label="Anguilla">Anguilla</option>
                                            <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="AR" label="Argentina">Argentina</option>
                                            <option value="AW" label="Aruba">Aruba</option>
                                            <option value="BS" label="Bahamas" selected="selected">Bahamas</option>
                                            <option value="BB" label="Barbados">Barbados</option>
                                            <option value="BZ" label="Belize">Belize</option>
                                            <option value="BM" label="Bermuda">Bermuda</option>
                                            <option value="BO" label="Bolivia">Bolivia</option>
                                            <option value="BR" label="Brazil">Brazil</option>
                                            <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                            <option value="CA" label="Canada" selected="selected">Canada</option>
                                            <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                            <option value="CL" label="Chile">Chile</option>
                                            <option value="CO" label="Colombia">Colombia</option>
                                            <option value="CR" label="Costa Rica">Costa Rica</option>
                                            <option value="CU" label="Cuba">Cuba</option>
                                            <option value="DM" label="Dominica">Dominica</option>
                                            <option value="DO" label="Dominican Republic">Dominican Republic</option>
                                            <option value="EC" label="Ecuador">Ecuador</option>
                                            <option value="SV" label="El Salvador">El Salvador</option>
                                            <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                            <option value="GF" label="French Guiana">French Guiana</option>
                                            <option value="GL" label="Greenland">Greenland</option>
                                            <option value="GD" label="Grenada">Grenada</option>
                                            <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                            <option value="GT" label="Guatemala">Guatemala</option>
                                            <option value="GY" label="Guyana">Guyana</option>
                                            <option value="HT" label="Haiti">Haiti</option>
                                            <option value="HN" label="Honduras">Honduras</option>
                                            <option value="JM" label="Jamaica">Jamaica</option>
                                            <option value="MQ" label="Martinique">Martinique</option>
                                            <option value="MX" label="Mexico">Mexico</option>
                                            <option value="MS" label="Montserrat">Montserrat</option>
                                            <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="NI" label="Nicaragua">Nicaragua</option>
                                            <option value="PA" label="Panama">Panama</option>
                                            <option value="PY" label="Paraguay">Paraguay</option>
                                            <option value="PE" label="Peru">Peru</option>
                                            <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                            <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                            <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                            <option value="MF" label="Saint Martin">Saint Martin</option>
                                            <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="SR" label="Suriname">Suriname</option>
                                            <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option value="US" label="United States">United States</option>
                                            <option value="UY" label="Uruguay">Uruguay</option>
                                            <option value="VE" label="Venezuela" selected="selected">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="ASIA">
                                            <option value="AF" label="Afghanistan">Afghanistan</option>
                                            <option value="AM" label="Armenia">Armenia</option>
                                            <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                            <option value="BH" label="Bahrain">Bahrain</option>
                                            <option value="BD" label="Bangladesh">Bangladesh</option>
                                            <option value="BT" label="Bhutan">Bhutan</option>
                                            <option value="BN" label="Brunei">Brunei</option>
                                            <option value="KH" label="Cambodia">Cambodia</option>
                                            <option value="CN" label="China">China</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="GE" label="Georgia">Georgia</option>
                                            <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                            <option value="IN" label="India">India</option>
                                            <option value="ID" label="Indonesia">Indonesia</option>
                                            <option value="IR" label="Iran">Iran</option>
                                            <option value="IQ" label="Iraq">Iraq</option>
                                            <option value="IL" label="Israel">Israel</option>
                                            <option value="JP" label="Japan">Japan</option>
                                            <option value="JO" label="Jordan">Jordan</option>
                                            <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                            <option value="KW" label="Kuwait">Kuwait</option>
                                            <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="LA" label="Laos">Laos</option>
                                            <option value="LB" label="Lebanon">Lebanon</option>
                                            <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                            <option value="MY" label="Malaysia">Malaysia</option>
                                            <option value="MV" label="Maldives">Maldives</option>
                                            <option value="MN" label="Mongolia">Mongolia</option>
                                            <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                            <option value="NP" label="Nepal">Nepal</option>
                                            <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                            <option value="KP" label="North Korea">North Korea</option>
                                            <option value="OM" label="Oman">Oman</option>
                                            <option value="PK" label="Pakistan">Pakistan</option>
                                            <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                            <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                            <option value="PH" label="Philippines">Philippines</option>
                                            <option value="QA" label="Qatar">Qatar</option>
                                            <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                            <option value="SG" label="Singapore" selected="selected">Singapore</option>
                                            <option value="KR" label="South Korea">South Korea</option>
                                            <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                            <option value="SY" label="Syria">Syria</option>
                                            <option value="TW" label="Taiwan">Taiwan</option>
                                            <option value="TJ" label="Tajikistan">Tajikistan</option>
                                            <option value="TH" label="Thailand">Thailand</option>
                                            <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                            <option value="TR" label="Turkey">Turkey</option>
                                            <option value="™" label="Turkmenistan">Turkmenistan</option>
                                            <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                            <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                            <option value="VN" label="Vietnam">Vietnam</option>
                                            <option value="YE" label="Yemen">Yemen</option>
                                        </optgroup>
                                        <optgroup label="EUROPE">
                                            <option value="AL" label="Albania">Albania</option>
                                            <option value="AD" label="Andorra">Andorra</option>
                                            <option value="AT" label="Austria">Austria</option>
                                            <option value="BY" label="Belarus">Belarus</option>
                                            <option value="BE" label="Belgium">Belgium</option>
                                            <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="BG" label="Bulgaria">Bulgaria</option>
                                            <option value="HR" label="Croatia">Croatia</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="CZ" label="Czech Republic">Czech Republic</option>
                                            <option value="DK" label="Denmark">Denmark</option>
                                            <option value="DD" label="East Germany">East Germany</option>
                                            <option value="EE" label="Estonia">Estonia</option>
                                            <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                            <option value="FI" label="Finland" selected="selected">Finland</option>
                                            <option value="FR" label="France">France</option>
                                            <option value="DE" label="Germany">Germany</option>
                                            <option value="GI" label="Gibraltar">Gibraltar</option>
                                            <option value="GR" label="Greece">Greece</option>
                                            <option value="GG" label="Guernsey">Guernsey</option>
                                            <option value="HU" label="Hungary">Hungary</option>
                                            <option value="IS" label="Iceland">Iceland</option>
                                            <option value="IE" label="Ireland">Ireland</option>
                                            <option value="IM" label="Isle of Man">Isle of Man</option>
                                            <option value="IT" label="Italy">Italy</option>
                                            <option value="JE" label="Jersey">Jersey</option>
                                            <option value="LV" label="Latvia">Latvia</option>
                                            <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                            <option value="LT" label="Lithuania">Lithuania</option>
                                            <option value="LU" label="Luxembourg">Luxembourg</option>
                                            <option value="MK" label="Macedonia">Macedonia</option>
                                            <option value="MT" label="Malta">Malta</option>
                                            <option value="FX" label="Metropolitan France">Metropolitan France</option>
                                            <option value="MD" label="Moldova">Moldova</option>
                                            <option value="MC" label="Monaco">Monaco</option>
                                            <option value="ME" label="Montenegro">Montenegro</option>
                                            <option value="NL" label="Netherlands">Netherlands</option>
                                            <option value="NO" label="Norway">Norway</option>
                                            <option value="PL" label="Poland">Poland</option>
                                            <option value="PT" label="Portugal">Portugal</option>
                                            <option value="RO" label="Romania">Romania</option>
                                            <option value="RU" label="Russia">Russia</option>
                                            <option value="SM" label="San Marino">San Marino</option>
                                            <option value="RS" label="Serbia">Serbia</option>
                                            <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="SK" label="Slovakia">Slovakia</option>
                                            <option value="SI" label="Slovenia">Slovenia</option>
                                            <option value="ES" label="Spain">Spain</option>
                                            <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="SE" label="Sweden">Sweden</option>
                                            <option value="CH" label="Switzerland">Switzerland</option>
                                            <option value="UA" label="Ukraine">Ukraine</option>
                                            <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                            <option value="GB" label="United Kingdom">United Kingdom</option>
                                            <option value="VA" label="Vatican City">Vatican City</option>
                                            <option value="AX" label="Åland Islands">Åland Islands</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <!--TAGS-->
                            <div class="form-group">
                                <label for="select2-example-tags" class="col-sm-2 control-label">Tagging</label>
                                <div class="col-sm-10">
                                    <select name="country" id="select2-example-tags" class="form-control select-tag-primary" multiple="multiple" style="width: 100%">
                                        <optgroup label="AMERICA">
                                            <option value="AI" label="Anguilla">Anguilla</option>
                                            <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="AR" label="Argentina">Argentina</option>
                                            <option value="AW" label="Aruba">Aruba</option>
                                            <option value="BS" label="Bahamas">Bahamas</option>
                                            <option value="BB" label="Barbados">Barbados</option>
                                            <option value="BZ" label="Belize">Belize</option>
                                            <option value="BM" label="Bermuda">Bermuda</option>
                                            <option value="BO" label="Bolivia">Bolivia</option>
                                            <option value="BR" label="Brazil">Brazil</option>
                                            <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                            <option value="CA" label="Canada">Canada</option>
                                            <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                            <option value="CL" label="Chile">Chile</option>
                                            <option value="CO" label="Colombia">Colombia</option>
                                            <option value="CR" label="Costa Rica">Costa Rica</option>
                                            <option value="CU" label="Cuba">Cuba</option>
                                            <option value="DM" label="Dominica">Dominica</option>
                                            <option value="DO" label="Dominican Republic">Dominican Republic</option>
                                            <option value="EC" label="Ecuador">Ecuador</option>
                                            <option value="SV" label="El Salvador">El Salvador</option>
                                            <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                            <option value="GF" label="French Guiana">French Guiana</option>
                                            <option value="GL" label="Greenland">Greenland</option>
                                            <option value="GD" label="Grenada">Grenada</option>
                                            <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                            <option value="GT" label="Guatemala">Guatemala</option>
                                            <option value="GY" label="Guyana">Guyana</option>
                                            <option value="HT" label="Haiti">Haiti</option>
                                            <option value="HN" label="Honduras">Honduras</option>
                                            <option value="JM" label="Jamaica">Jamaica</option>
                                            <option value="MQ" label="Martinique">Martinique</option>
                                            <option value="MX" label="Mexico">Mexico</option>
                                            <option value="MS" label="Montserrat">Montserrat</option>
                                            <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="NI" label="Nicaragua">Nicaragua</option>
                                            <option value="PA" label="Panama">Panama</option>
                                            <option value="PY" label="Paraguay">Paraguay</option>
                                            <option value="PE" label="Peru">Peru</option>
                                            <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                            <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                            <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                            <option value="MF" label="Saint Martin">Saint Martin</option>
                                            <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="SR" label="Suriname">Suriname</option>
                                            <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option value="US" label="United States">United States</option>
                                            <option value="UY" label="Uruguay">Uruguay</option>
                                            <option value="VE" label="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="ASIA">
                                            <option value="AF" label="Afghanistan">Afghanistan</option>
                                            <option value="AM" label="Armenia">Armenia</option>
                                            <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                            <option value="BH" label="Bahrain">Bahrain</option>
                                            <option value="BD" label="Bangladesh">Bangladesh</option>
                                            <option value="BT" label="Bhutan">Bhutan</option>
                                            <option value="BN" label="Brunei">Brunei</option>
                                            <option value="KH" label="Cambodia">Cambodia</option>
                                            <option value="CN" label="China">China</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="GE" label="Georgia">Georgia</option>
                                            <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                            <option value="IN" label="India">India</option>
                                            <option value="ID" label="Indonesia">Indonesia</option>
                                            <option value="IR" label="Iran">Iran</option>
                                            <option value="IQ" label="Iraq">Iraq</option>
                                            <option value="IL" label="Israel">Israel</option>
                                            <option value="JP" label="Japan">Japan</option>
                                            <option value="JO" label="Jordan">Jordan</option>
                                            <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                            <option value="KW" label="Kuwait">Kuwait</option>
                                            <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="LA" label="Laos">Laos</option>
                                            <option value="LB" label="Lebanon">Lebanon</option>
                                            <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                            <option value="MY" label="Malaysia">Malaysia</option>
                                            <option value="MV" label="Maldives">Maldives</option>
                                            <option value="MN" label="Mongolia">Mongolia</option>
                                            <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                            <option value="NP" label="Nepal">Nepal</option>
                                            <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                            <option value="KP" label="North Korea">North Korea</option>
                                            <option value="OM" label="Oman">Oman</option>
                                            <option value="PK" label="Pakistan">Pakistan</option>
                                            <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                            <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                            <option value="PH" label="Philippines">Philippines</option>
                                            <option value="QA" label="Qatar">Qatar</option>
                                            <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                            <option value="SG" label="Singapore" selected="selected">Singapore</option>
                                            <option value="KR" label="South Korea">South Korea</option>
                                            <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                            <option value="SY" label="Syria">Syria</option>
                                            <option value="TW" label="Taiwan">Taiwan</option>
                                            <option value="TJ" label="Tajikistan">Tajikistan</option>
                                            <option value="TH" label="Thailand">Thailand</option>
                                            <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                            <option value="TR" label="Turkey">Turkey</option>
                                            <option value="™" label="Turkmenistan">Turkmenistan</option>
                                            <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                            <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                            <option value="VN" label="Vietnam">Vietnam</option>
                                            <option value="YE" label="Yemen">Yemen</option>
                                        </optgroup>
                                        <optgroup label="EUROPE">
                                            <option value="AL" label="Albania">Albania</option>
                                            <option value="AD" label="Andorra">Andorra</option>
                                            <option value="AT" label="Austria">Austria</option>
                                            <option value="BY" label="Belarus">Belarus</option>
                                            <option value="BE" label="Belgium">Belgium</option>
                                            <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="BG" label="Bulgaria">Bulgaria</option>
                                            <option value="HR" label="Croatia">Croatia</option>
                                            <option value="CY" label="Cyprus">Cyprus</option>
                                            <option value="CZ" label="Czech Republic">Czech Republic</option>
                                            <option value="DK" label="Denmark">Denmark</option>
                                            <option value="DD" label="East Germany">East Germany</option>
                                            <option value="EE" label="Estonia">Estonia</option>
                                            <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                            <option value="FI" label="Finland" selected="selected">Finland</option>
                                            <option value="FR" label="France">France</option>
                                            <option value="DE" label="Germany">Germany</option>
                                            <option value="GI" label="Gibraltar">Gibraltar</option>
                                            <option value="GR" label="Greece">Greece</option>
                                            <option value="GG" label="Guernsey">Guernsey</option>
                                            <option value="HU" label="Hungary">Hungary</option>
                                            <option value="IS" label="Iceland">Iceland</option>
                                            <option value="IE" label="Ireland">Ireland</option>
                                            <option value="IM" label="Isle of Man">Isle of Man</option>
                                            <option value="IT" label="Italy">Italy</option>
                                            <option value="JE" label="Jersey">Jersey</option>
                                            <option value="LV" label="Latvia">Latvia</option>
                                            <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                            <option value="LT" label="Lithuania">Lithuania</option>
                                            <option value="LU" label="Luxembourg">Luxembourg</option>
                                            <option value="MK" label="Macedonia">Macedonia</option>
                                            <option value="MT" label="Malta">Malta</option>
                                            <option value="FX" label="Metropolitan France">Metropolitan France</option>
                                            <option value="MD" label="Moldova">Moldova</option>
                                            <option value="MC" label="Monaco">Monaco</option>
                                            <option value="ME" label="Montenegro">Montenegro</option>
                                            <option value="NL" label="Netherlands">Netherlands</option>
                                            <option value="NO" label="Norway">Norway</option>
                                            <option value="PL" label="Poland">Poland</option>
                                            <option value="PT" label="Portugal">Portugal</option>
                                            <option value="RO" label="Romania">Romania</option>
                                            <option value="RU" label="Russia">Russia</option>
                                            <option value="SM" label="San Marino">San Marino</option>
                                            <option value="RS" label="Serbia">Serbia</option>
                                            <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                            <option value="SK" label="Slovakia">Slovakia</option>
                                            <option value="SI" label="Slovenia">Slovenia</option>
                                            <option value="ES" label="Spain">Spain</option>
                                            <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="SE" label="Sweden">Sweden</option>
                                            <option value="CH" label="Switzerland">Switzerland</option>
                                            <option value="UA" label="Ukraine">Ukraine</option>
                                            <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                            <option value="GB" label="United Kingdom">United Kingdom</option>
                                            <option value="VA" label="Vatican City">Vatican City</option>
                                            <option value="AX" label="Åland Islands">Åland Islands</option>
                                        </optgroup>
                                        <optgroup label="other">
                                            <option value="1" label="write" selected="selected">write</option>
                                            <option value="2" label="your" selected="selected">your</option>
                                            <option value="3" label="tag" selected="selected">tag</option>
                                        </optgroup>
                                    </select>
                                    <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Select from pre-existing options or create a new tag, use ',' to separate them.</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--DATE PICKER-->
    <div class="col-sm-6">
        <h4 class="section-subtitle"><b>Date picker</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--DEFAULT datepicker-->
                            <div class="form-group">
                                <label for="default-datepicker" class="col-sm-2 control-label ">Default</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" id="default-datepicker">
                                    </div>
                                </div>
                            </div>
                            <!--RANGE datepicker-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Range</label>
                                <div class="col-sm-10">
                                    <div class="input-daterange input-group" id="range-datepicker">
                                        <input type="text" class="input-sm form-control" name="start" />
                                        <span class="input-group-addon x-primary">to</span>
                                        <input type="text" class="input-sm form-control" name="end" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--TIME PICKER-->
    <div class="col-sm-6">
        <h4 class="section-subtitle"><b>Time picker</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--DEFAULT timepicker-->
                            <div class="form-group">
                                <label for="default-timepicker" class="col-sm-2 control-label ">Default</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" id="default-timepicker">
                                    </div>
                                </div>
                            </div>
                            <!--24h datepicker-->
                            <div class="form-group">
                                <label for="24-timepicker" class="col-sm-2 control-label ">24 Hours</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" id="24-timepicker">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--COLOR PICKER-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Color picker</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--HEX colorpicker-->
                            <div class="form-group">
                                <label for="hex-colorpicker" class="col-sm-2 control-label">HEX</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="hex-colorpicker" value="0066BA">
                                </div>
                            </div>
                            <!--RGBA datepicker-->
                            <div class="form-group">
                                <label for="rgba-colorpicker" class="col-sm-2 control-label">RGBA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rgba-colorpicker" value="rgba(0, 102, 186,1)">
                                </div>
                            </div>
                            <!--ALL FORMATS datepicker-->
                            <div class="form-group">
                                <label for="all-formats-colorpicker" class="col-sm-2 control-label">All formats</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="all-formats-colorpicker" value="rgb(0, 102, 186)">
                                </div>
                            </div>
                            <!--COMPONENT datepicker-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Component</label>
                                <div class="col-sm-10">
                                    <div id="component-colorpicker" class="input-group colorpicker-component">
                                        <input type="text" class="form-control" value="0066BA">
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('css')
     <!--Select with searching & tagging-->
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap.min.css') }}">
    <!--Date picker-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    <!--Time picker-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap_time-picker/css/timepicker.css') }}">
    <!--Color picker-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap_color-picker/css/bootstrap-colorpicker.min.css') }}">
    <!--TEMPLATE css-->
@stop
@endsection
@section('script')
     <script src="{{ asset('vendor/bootstrap_max-lenght/bootstrap-maxlength.js') }}"></script>
     <!--Select with searching & tagging-->
     <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
     <!--Input mask-->
     <script src="{{ asset('vendor/input-masked/inputmask.bundle.min.js') }}"></script>
     <script src="{{ asset('vendor/input-masked/phone-codes/phone.js') }}"></script>
     <!--Date picker-->
     <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
     <!--Time picker-->
     <script src="{{ asset('vendor/bootstrap_time-picker/js/bootstrap-timepicker.js') }}"></script>
     <!--Color picker-->
     <script src="{{ asset('vendor/bootstrap_color-picker/js/bootstrap-colorpicker.min.js') }}"></script>
     <!--Examples-->
     <script src="{{ asset('js/examples/forms/advanced.js') }}"></script>
@stop
