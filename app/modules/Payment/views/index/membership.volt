<div id="membership-content" class="quest">
  <div class="row">
    <div class="col-12">
      <div class="full-text">
        <h1 class="title-center">{{ helper.translate('Questionnaire') }}</h1>
        <form action="payment/index" class="payme-member" method="post" enctype="multipart/form-data" id="memForm">
          <div class="dflex">
            <div class="col-md-6">
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Name of company') }} <span class="text-red">*</span></label>
                <input type="text" class="input-red" name="company_name" id="company_name" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Address of company') }} <span class="text-red">*</span></label>
                <input type="text" class="input-red" name="address" id="address" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Sphere') }} <span class="text-red">*</span></label>
                <input type="text" class="input-red" name="sphere" id="sphere" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Fio') }}<span class="text-red">*</span></label>
                <input type="text" class="input-red" name="fio" id="fio" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Status of company') }}<span class="text-red">*</span></label>
                <select class="input-red memselect" name="company_status" id="company_status" required="required">
                  <option value="">{{helper.translate('Choose')}}</option>
                  <option value="Legal entity">{{helper.translate('Legal entity')}}</option>
                  <option value="Individual entity">{{helper.translate('Individual entity')}}</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Website') }} <span class="text-red">*</span></label>
                <input type="text" class="input-red" name="website" id="website" placeholder="www.your-company.uz" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Phone') }} <span class="text-red">*</span></label>
                <input type="tell" name="phone" class="input-red" id="phone" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Email') }} <span class="text-red">*</span></label>
                 <input type="email" name="email" class="input-red" id="email" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Count of employee') }}<span class="text-red">*</span></label>
                <input type="number" class="input-red" name="employee_count" id="employee_count" required="required">
              </div>
              <div class="input-group">
                <label class="input-label">{{ helper.translate('Registration Date') }} <span class="text-red">*</span></label>
                <input type="date" class="input-red" name="registration_date" id="registration_date" required="required">
              </div>
            </div>
            <div class="col-md-6 mt-5">
              <label class="input-label">{{ helper.translate('Category of company') }}<span class="text-red">*</span></label>
              <div class="border-orange">
                <div class="input-group">
                  <input type="radio" class="ccategory" name="category" id="category" value="LTD">
                  <label for="category" class="label-checkbox">{{helper.translate('LTD')}}</label>
                </div>
                <div class="input-group">
                  <input type="radio" class="ccategory" name="category" id="category-2" value="SE">
                  <label for="category-2" class="label-checkbox">{{helper.translate('SE')}}</label>
                </div>
                <div class="input-group">
                  <input type="radio"  class="ccategory"name="category" id="category-3" value="ME">
                  <label for="category-3" class="label-checkbox">{{helper.translate('ME')}}</label>
                </div>
                <div class="input-group">
                  <input type="radio" class="ccategory other" name="category" id="category-4" value="">
                  <label for="category-4" class="label-checkbox">{{helper.translate('Other')}}</label>
                  <input type="text" name="text" id="text" value="" class="input-red" style="display:none;">
                </div>
                <div class="alert alert-danger" id="cc" style="display:none;">{{helper.translate('Please select on of the field')}}</div>
              </div>
            </div>
            <div class="col-md-6 mt-5">
              <label class="input-label">{{ helper.translate('Thematic areas') }} <span>*</span></label>
              <div class="border-orange">
                <div class="input-group">
                  <input id="thematic_areas" class="thematic_areas"  type="radio" name="thematic_areas" value="Thematic One">
                  <label for="thematic_areas" class="label-checkbox">{{ helper.translate('Thematic One') }}</label>
                </div>
                <div class="input-group">
                  <input id="thematic_areas-2" class="thematic_areas"  type="radio" name="thematic_areas" value="Thematic Two">
                  <label for="thematic_areas-2" class="label-checkbox">{{ helper.translate('Thematic Two') }}</label>
                </div>
                <div class="input-group">
                  <input id="thematic_areas-3"  class="thematic_areas" type="radio" name="thematic_areas" value="Thematic Three">
                  <label for="thematic_areas-3" class="label-checkbox">{{ helper.translate('Thematic Three') }}</label>
                </div>
                <div class="input-group">
                  <input id="thematic_areas-4" class="thematic_areas"  type="radio" name="thematic_areas" value="Thematic Four">
                  <label for="thematic_areas-4" class="label-checkbox">{{ helper.translate('Thematic Four') }}</label>
                </div>
                <div class="input-group">
                  <input id="thematic_areas-5" class="thematic_areas"  type="radio" name="thematic_areas" value="">
                  <label for="thematic_areas-5" class="label-checkbox">{{ helper.translate('Other') }}</label>
                  <input type="text" class="input-red" name="" id="temOther" value="" style="display:none;">
                </div>
                <div class="alert alert-danger" id="ta" style="display:none;">{{helper.translate('Please select on of the field')}}</div>
              </div>
            </div>
            <div class="col-md-6 mt-5">
              <label class="input-label">{{ helper.translate('How to know') }} <span class="text-red">*</span></label>
              <div class="border-orange">
                <div class="input-group">
                  <input id="checkbox-10" class="how"  type="radio" name="howtoknow" value="Howtoknow One">
                  <label for="checkbox-10" class="label-checkbox">{{ helper.translate('Howtoknow One') }}</label>
                </div>
                <div class="input-group">
                  <input id="checkbox-11" class="how"  type="radio" name="howtoknow" value="Howtoknow Two">
                  <label for="checkbox-11" class="label-checkbox">{{ helper.translate('Howtoknow Two') }}</label>
                </div>
                <div class="input-group">
                  <input id="checkbox-12" class="how"  type="radio" name="howtoknow" value="Howtoknow Three">
                  <label for="checkbox-12" class="label-checkbox">{{ helper.translate('Howtoknow Three') }}</label>
                </div>
                <div class="input-group">
                  <input id="checkbox-13" class="how"  type="radio" name="howtoknow" value="Howtoknow Four">
                  <label for="checkbox-13" class="label-checkbox">{{ helper.translate('Howtoknow Four') }}</label>
                </div>
                <div class="input-group">
                  <input id="checkbox_14" class="how"  type="radio" name="howtoknow" value="Other">
                  <label for="checkbox_14" class="label-checkbox">{{ helper.translate('Other') }}</label>
                  <input type="text" class="input-red" name="" id="howOther" value="" style="display:none;">
                </div>
                <div class="alert alert-danger" id="htk" style="display:none;">{{helper.translate('Please select on of the field')}}</div>
              </div>
            </div>
            <div class="col-md-6 mt-5 d-flex-center">
              <div class="input-group">
                <input id="agree_correct"  type="checkbox" name="agree_correct">
                <label for="agree_correct" class="label-checkbox">{{ helper.translate('Agree and correct') }}</label>
              </div>
              <div class="alert alert-danger" id="conf" style="display:none;">{{helper.translate('Please select confirmation')}}</div>
              <button type="submit" class="btn-orange" id="btn-orange">{{helper.translate('Send')}}</button>
            </div>
          </div>
        </form><!-- /. form -->
      </div>
    </div>
  </div>
</div>
<script src="/assets/js/membershipForm.js"></script>
