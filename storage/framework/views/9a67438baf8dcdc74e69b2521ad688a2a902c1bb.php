<?php $__env->startSection('title', \App\CPU\translate('Web Config')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/back-end/css/custom.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item"
                    aria-current="page"><?php echo e(\App\CPU\translate('Website')); ?> <?php echo e(\App\CPU\translate('Info')); ?> </li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px;">
            <div class="col-md-12 mb-3 mt-3">
                <div class="alert alert-danger mb-3" role="alert">
                    <?php echo e(\App\CPU\translate('changing_some_settings_will_take_time_to_show_effect_please_clear_session_or_wait_for_60_minutes_else_browse_from_incognito_mode')); ?>

                </div>

                <div class="card">
                    <div class="card-body" style="padding-bottom: 12px">
                        <div class="row flex-between mx-1">
                            <?php ($config=\App\CPU\Helpers::get_business_settings('maintenance_mode')); ?>
                            <div class="flex-between">
                                <h5 class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"><i
                                        class="tio-settings-outlined"></i></h5>
                                <h5><?php echo e(\App\CPU\translate('maintenance_mode')); ?></h5>
                            </div>
                            <div>
                                <label
                                    class="switch ml-3 float-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>">
                                    <input type="checkbox" class="status" onclick="maintenance_mode()"
                                        <?php echo e(isset($config) && $config?'checked':''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center"><i
                                class="tio-money"></i> <?php echo e(\App\CPU\translate('Currency Symbol Position')); ?></h5>
                        <i class="tio-dollar"></i>
                    </div>
                    <div class="card-body">
                        <?php ($config=\App\CPU\Helpers::get_business_settings('currency_symbol_position')); ?>
                        <div class="form-row">
                            <div class="col-sm mb-2 mb-sm-0">
                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio custom-radio-reverse"
                                         onclick="currency_symbol_position('<?php echo e(route('admin.business-settings.web-config.currency-symbol-position',['left'])); ?>')">
                                        <input type="radio" class="custom-control-input"
                                               name="projectViewNewProjectTypeRadio"
                                               id="projectViewNewProjectTypeRadio1" <?php echo e((isset($config) && $config=='left')?'checked':''); ?>>
                                        <label class="custom-control-label media align-items-center"
                                               for="projectViewNewProjectTypeRadio1">
                                            <i class="tio-agenda-view-outlined text-muted mr-2"></i>
                                            <span class="media-body">
                                               <?php echo e(\App\CPU\BackEndHelper::currency_symbol()); ?> <?php echo e(\App\CPU\translate('Left')); ?>

                                              </span>
                                        </label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->
                            </div>

                            <div class="col-sm mb-2 mb-sm-0">
                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio custom-radio-reverse"
                                         onclick="currency_symbol_position('<?php echo e(route('admin.business-settings.web-config.currency-symbol-position',['right'])); ?>')">
                                        <input type="radio" class="custom-control-input"
                                               name="projectViewNewProjectTypeRadio"
                                               id="projectViewNewProjectTypeRadio2" <?php echo e((isset($config) && $config=='right')?'checked':''); ?>>
                                        <label class="custom-control-label media align-items-center"
                                               for="projectViewNewProjectTypeRadio2">
                                            <i class="tio-table text-muted mr-2"></i>
                                            <span
                                                class="media-body"><?php echo e(\App\CPU\translate('Right')); ?> <?php echo e(\App\CPU\BackEndHelper::currency_symbol()); ?></span>
                                        </label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('apple_store')); ?> <?php echo e(\App\CPU\translate('Status')); ?></h5>
                    </div>
                    <div class="card-body" style="padding: 20px">

                        <?php ($config=\App\CPU\Helpers::get_business_settings('download_app_apple_stroe')); ?>
                        <form style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              action="<?php echo e(route('admin.business-settings.web-config.app-store-update',['download_app_apple_stroe'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('link')); ?></label><br>
                                    <input type="text" class="form-control" name="link" value="<?php echo e($config['link']); ?>"
                                           required>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('google_play_store')); ?> <?php echo e(\App\CPU\translate('Status')); ?></h5>
                    </div>
                    <div class="card-body" style="padding: 20px">

                        <?php ($config=\App\CPU\Helpers::get_business_settings('download_app_google_stroe')); ?>
                        <form style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              action="<?php echo e(route('admin.business-settings.web-config.app-store-update',['download_app_google_stroe'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('link')); ?></label><br>
                                    <input type="text" class="form-control" name="link" value="<?php echo e($config['link']); ?>"
                                           required>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>


        </div>

        <div
            style="padding: 10px;background: white;border-radius: 10px; text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
            <h3>Web config Form</h3>
            <form action="<?php echo e(route('admin.business-settings.update-info')); ?>" method="POST"
                  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="flex-between">
                                    <div class="flex-between">
                                        <div class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"><i
                                                class="tio-shop"></i></div>
                                        <h5><?php echo e(\App\CPU\translate('Admin Shop Banner')); ?></h5>
                                    </div>
                                    <div class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"><small
                                            style="color: red"><?php echo e(\App\CPU\translate('Ratio')); ?> ( <?php echo e(\App\CPU\translate('6:1')); ?> )</small></div>
                                </div>
                                <div><i class="tio-panorama-image"></i></div>
                            </div>
                            <div class="card-body" style="padding: 20px">
                                <center>
                                    <img height="200" style="width: 100%" id="viewerShop"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/shop')); ?>/<?php echo e(\App\CPU\Helpers::get_business_settings('shop_banner')); ?>">
                                </center>
                                <hr>
                                <div class="row pl-4 pr-4">
                                    <div class="col-12" style="text-align: left">
                                        <input type="file" name="shop_banner" id="customFileUploadShop"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUploadShop">
                                            <?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-6">
                        <?php ($companyName=\App\Model\BusinessSetting::where('type','company_name')->first()); ?>
                        <div class="form-group">
                            <label
                                class="input-label"><?php echo e(\App\CPU\translate('company')); ?> <?php echo e(\App\CPU\translate('name')); ?></label>
                            <input class="form-control" type="text" name="company_name"
                                   value="<?php echo e($companyName->value?$companyName->value:" "); ?>"
                                   placeholder="New Business">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php ($company_email=\App\Model\BusinessSetting::where('type','company_email')->first()); ?>
                        <div class="form-group">
                            <label
                                class="input-label"><?php echo e(\App\CPU\translate('company')); ?> <?php echo e(\App\CPU\translate('Email')); ?></label>
                            <input class="form-control" type="text" name="company_email"
                                   value="<?php echo e($company_email->value?$company_email->value:" "); ?>"
                                   placeholder="New Business">
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-4">
                        <?php ($company_phone=\App\Model\BusinessSetting::where('type','company_phone')->first()); ?>
                        <div class="form-group">
                            <label class="input-label"><?php echo e(\App\CPU\translate('Phone')); ?></label>
                            <input class="form-control" type="text" name="company_phone"
                                   value="<?php echo e($company_phone->value?$company_phone->value:""); ?>"
                                   placeholder="New Business">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <?php ($pagination_limit=\App\CPU\Helpers::get_business_settings('pagination_limit')); ?>
                        <div class="form-group">
                            <label
                                class="input-label"><?php echo e(\App\CPU\translate('pagination')); ?> <?php echo e(\App\CPU\translate('settings')); ?></label>
                            <input type="number" value="<?php echo e($pagination_limit); ?>"
                                   name="pagination_limit" class="form-control" placeholder="25">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php ($company_copyright_text=\App\Model\BusinessSetting::where('type','company_copyright_text')->first()); ?>
                        <div class="form-group">
                            <label
                                class="input-label"><?php echo e(\App\CPU\translate('rename_company')); ?> <?php echo e(\App\CPU\translate('copy_right')); ?> <?php echo e(\App\CPU\translate('Text')); ?></label>
                            <input class="form-control" type="text" name="company_copyright_text"
                                   value="<?php echo e($company_copyright_text->value?$company_copyright_text->value:" "); ?>"
                                   placeholder="New Business">
                        </div>
                    </div>
                </div>

                <?php ($tz=\App\Model\BusinessSetting::where('type','timezone')->first()); ?>
                <?php ($tz=$tz?$tz->value:0); ?>
                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label
                                class="input-label d-inline text-capitalize"><?php echo e(\App\CPU\translate('time')); ?> <?php echo e(\App\CPU\translate('zone')); ?></label>
                            <select name="timezone" class="form-control js-select2-custom">
                                <option value="UTC" <?php echo e($tz?($tz==''?'selected':''):''); ?>>UTC</option>
                                <option value="Etc/GMT+12" <?php echo e($tz?($tz=='Etc/GMT+12'?'selected':''):''); ?>>(GMT-12:00)
                                    International Date Line West
                                </option>
                                <option value="Pacific/Midway" <?php echo e($tz?($tz=='Pacific/Midway'?'selected':''):''); ?>>
                                    (GMT-11:00)
                                    Midway Island, Samoa
                                </option>
                                <option value="Pacific/Honolulu" <?php echo e($tz?($tz=='Pacific/Honolulu'?'selected':''):''); ?>>
                                    (GMT-10:00)
                                    Hawaii
                                </option>
                                <option value="US/Alaska" <?php echo e($tz?($tz=='US/Alaska'?'selected':''):''); ?>>(GMT-09:00) Alaska
                                </option>
                                <option
                                    value="America/Los_Angeles" <?php echo e($tz?($tz=='America/Los_Angeles'?'selected':''):''); ?>>
                                    (GMT-08:00) Pacific Time (US & Canada)
                                </option>
                                <option value="America/Tijuana" <?php echo e($tz?($tz=='America/Tijuana'?'selected':''):''); ?>>
                                    (GMT-08:00)
                                    Tijuana, Baja California
                                </option>
                                <option value="US/Arizona" <?php echo e($tz?($tz=='US/Arizona'?'selected':''):''); ?>>(GMT-07:00)
                                    Arizona
                                </option>
                                <option value="America/Chihuahua" <?php echo e($tz?($tz=='America/Chihuahua'?'selected':''):''); ?>>
                                    (GMT-07:00) Chihuahua, La Paz, Mazatlan
                                </option>
                                <option value="US/Mountain" <?php echo e($tz?($tz=='US/Mountain'?'selected':''):''); ?>>(GMT-07:00)
                                    Mountain
                                    Time (US & Canada)
                                </option>
                                <option value="America/Managua" <?php echo e($tz?($tz=='America/Managua'?'selected':''):''); ?>>
                                    (GMT-06:00)
                                    Central America
                                </option>
                                <option value="US/Central" <?php echo e($tz?($tz=='US/Central'?'selected':''):''); ?>>(GMT-06:00)
                                    Central Time
                                    (US & Canada)
                                </option>
                                <option
                                    value="America/Mexico_City" <?php echo e($tz?($tz=='America/Mexico_City'?'selected':''):''); ?>>
                                    (GMT-06:00) Guadalajara, Mexico City, Monterrey
                                </option>
                                <option
                                    value="Canada/Saskatchewan" <?php echo e($tz?($tz=='Canada/Saskatchewan'?'selected':''):''); ?>>
                                    (GMT-06:00) Saskatchewan
                                </option>
                                <option value="America/Bogota" <?php echo e($tz?($tz=='America/Bogota'?'selected':''):''); ?>>
                                    (GMT-05:00)
                                    Bogota, Lima, Quito, Rio Branco
                                </option>
                                <option value="US/Eastern" <?php echo e($tz?($tz=='US/Eastern'?'selected':''):''); ?>>(GMT-05:00)
                                    Eastern Time
                                    (US & Canada)
                                </option>
                                <option value="US/East-Indiana" <?php echo e($tz?($tz=='US/East-Indiana'?'selected':''):''); ?>>
                                    (GMT-05:00)
                                    Indiana (East)
                                </option>
                                <option value="Canada/Atlantic" <?php echo e($tz?($tz=='Canada/Atlantic'?'selected':''):''); ?>>
                                    (GMT-04:00)
                                    Atlantic Time (Canada)
                                </option>
                                <option value="America/Caracas" <?php echo e($tz?($tz=='America/Caracas'?'selected':''):''); ?>>
                                    (GMT-04:00)
                                    Caracas, La Paz
                                </option>
                                <option value="America/Manaus" <?php echo e($tz?($tz=='America/Manaus'?'selected':''):''); ?>>
                                    (GMT-04:00)
                                    Manaus
                                </option>
                                <option value="America/Santiago" <?php echo e($tz?($tz=='America/Santiago'?'selected':''):''); ?>>
                                    (GMT-04:00)
                                    Santiago
                                </option>
                                <option
                                    value="Canada/Newfoundland" <?php echo e($tz?($tz=='Canada/Newfoundland'?'selected':''):''); ?>>
                                    (GMT-03:30) Newfoundland
                                </option>
                                <option value="America/Sao_Paulo" <?php echo e($tz?($tz=='America/Sao_Paulo'?'selected':''):''); ?>>
                                    (GMT-03:00) Brasilia
                                </option>
                                <option
                                    value="America/Argentina/Buenos_Aires" <?php echo e($tz?($tz=='America/Argentina/Buenos_Aires'?'selected':''):''); ?>>
                                    (GMT-03:00) Buenos Aires, Georgetown
                                </option>
                                <option value="America/Godthab" <?php echo e($tz?($tz=='America/Godthab'?'selected':''):''); ?>>
                                    (GMT-03:00)
                                    Greenland
                                </option>
                                <option value="America/Montevideo" <?php echo e($tz?($tz=='America/Montevideo'?'selected':''):''); ?>>
                                    (GMT-03:00) Montevideo
                                </option>
                                <option value="America/Noronha" <?php echo e($tz?($tz=='America/Noronha'?'selected':''):''); ?>>
                                    (GMT-02:00)
                                    Mid-Atlantic
                                </option>
                                <option
                                    value="Atlantic/Cape_Verde" <?php echo e($tz?($tz=='Atlantic/Cape_Verde'?'selected':''):''); ?>>
                                    (GMT-01:00) Cape Verde Is.
                                </option>
                                <option value="Atlantic/Azores" <?php echo e($tz?($tz=='Atlantic/Azores'?'selected':''):''); ?>>
                                    (GMT-01:00)
                                    Azores
                                </option>
                                <option value="Africa/Casablanca" <?php echo e($tz?($tz=='Africa/Casablanca'?'selected':''):''); ?>>
                                    (GMT+00:00) Casablanca, Monrovia, Reykjavik
                                </option>
                                <option value="Etc/Greenwich" <?php echo e($tz?($tz=='Etc/Greenwich'?'selected':''):''); ?>>
                                    (GMT+00:00)
                                    Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London
                                </option>
                                <option value="Europe/Amsterdam" <?php echo e($tz?($tz=='Europe/Amsterdam'?'selected':''):''); ?>>
                                    (GMT+01:00)
                                    Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna
                                </option>
                                <option value="Europe/Belgrade" <?php echo e($tz?($tz=='Europe/Belgrade'?'selected':''):''); ?>>
                                    (GMT+01:00)
                                    Belgrade, Bratislava, Budapest, Ljubljana, Prague
                                </option>
                                <option value="Europe/Brussels" <?php echo e($tz?($tz=='Europe/Brussels'?'selected':''):''); ?>>
                                    (GMT+01:00)
                                    Brussels, Copenhagen, Madrid, Paris
                                </option>
                                <option value="Europe/Sarajevo" <?php echo e($tz?($tz=='Europe/Sarajevo'?'selected':''):''); ?>>
                                    (GMT+01:00)
                                    Sarajevo, Skopje, Warsaw, Zagreb
                                </option>
                                <option value="Africa/Lagos" <?php echo e($tz?($tz=='Africa/Lagos'?'selected':''):''); ?>>(GMT+01:00)
                                    West
                                    Central Africa
                                </option>
                                <option value="Asia/Amman" <?php echo e($tz?($tz=='Asia/Amman'?'selected':''):''); ?>>(GMT+02:00)
                                    Amman
                                </option>
                                <option value="Europe/Athens" <?php echo e($tz?($tz=='Europe/Athens'?'selected':''):''); ?>>
                                    (GMT+02:00)
                                    Athens, Bucharest, Istanbul
                                </option>
                                <option value="Asia/Beirut" <?php echo e($tz?($tz=='Asia/Beirut'?'selected':''):''); ?>>(GMT+02:00)
                                    Beirut
                                </option>
                                <option value="Africa/Cairo" <?php echo e($tz?($tz=='Africa/Cairo'?'selected':''):''); ?>>(GMT+02:00)
                                    Cairo
                                </option>
                                <option value="Africa/Harare" <?php echo e($tz?($tz=='Africa/Harare'?'selected':''):''); ?>>
                                    (GMT+02:00)
                                    Harare, Pretoria
                                </option>
                                <option value="Europe/Helsinki" <?php echo e($tz?($tz=='Europe/Helsinki'?'selected':''):''); ?>>
                                    (GMT+02:00)
                                    Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius
                                </option>
                                <option value="Asia/Jerusalem" <?php echo e($tz?($tz=='Asia/Jerusalem'?'selected':''):''); ?>>
                                    (GMT+02:00)
                                    Jerusalem
                                </option>
                                <option value="Europe/Minsk" <?php echo e($tz?($tz=='Europe/Minsk'?'selected':''):''); ?>>(GMT+02:00)
                                    Minsk
                                </option>
                                <option value="Africa/Windhoek" <?php echo e($tz?($tz=='Africa/Windhoek'?'selected':''):''); ?>>
                                    (GMT+02:00)
                                    Windhoek
                                </option>
                                <option value="Asia/Kuwait" <?php echo e($tz?($tz=='Asia/Kuwait'?'selected':''):''); ?>>(GMT+03:00)
                                    Kuwait,
                                    Riyadh, Baghdad
                                </option>
                                <option value="Europe/Moscow" <?php echo e($tz?($tz=='Europe/Moscow'?'selected':''):''); ?>>
                                    (GMT+03:00)
                                    Moscow, St. Petersburg, Volgograd
                                </option>
                                <option value="Africa/Nairobi" <?php echo e($tz?($tz=='Africa/Nairobi'?'selected':''):''); ?>>
                                    (GMT+03:00)
                                    Nairobi
                                </option>
                                <option value="Asia/Tbilisi" <?php echo e($tz?($tz=='Asia/Tbilisi'?'selected':''):''); ?>>(GMT+03:00)
                                    Tbilisi
                                </option>
                                <option value="Asia/Tehran" <?php echo e($tz?($tz=='Asia/Tehran'?'selected':''):''); ?>>(GMT+03:30)
                                    Tehran
                                </option>
                                <option value="Asia/Muscat" <?php echo e($tz?($tz=='Asia/Muscat'?'selected':''):''); ?>>(GMT+04:00)
                                    Abu Dhabi,
                                    Muscat
                                </option>
                                <option value="Asia/Baku" <?php echo e($tz?($tz=='Asia/Baku'?'selected':''):''); ?>>(GMT+04:00) Baku
                                </option>
                                <option value="Asia/Yerevan" <?php echo e($tz?($tz=='Asia/Yerevan'?'selected':''):''); ?>>(GMT+04:00)
                                    Yerevan
                                </option>
                                <option value="Asia/Kabul" <?php echo e($tz?($tz=='Asia/Kabul'?'selected':''):''); ?>>(GMT+04:30)
                                    Kabul
                                </option>
                                <option value="Asia/Yekaterinburg" <?php echo e($tz?($tz=='Asia/Yekaterinburg'?'selected':''):''); ?>>
                                    (GMT+05:00) Yekaterinburg
                                </option>
                                <option value="Asia/Karachi" <?php echo e($tz?($tz=='Asia/Karachi'?'selected':''):''); ?>>(GMT+05:00)
                                    Islamabad, Karachi, Tashkent
                                </option>
                                <option value="Asia/Calcutta" <?php echo e($tz?($tz=='Asia/Calcutta'?'selected':''):''); ?>>
                                    (GMT+05:30)
                                    Chennai, Kolkata, Mumbai, New Delhi
                                </option>
                            <!-- <option value="Asia/Calcutta"  <?php echo e($tz?($tz=='Asia/Calcutta'?'selected':''):''); ?>>(GMT+05:30) Sri Jayawardenapura</option> -->
                                <option value="Asia/Katmandu" <?php echo e($tz?($tz=='Asia/Katmandu'?'selected':''):''); ?>>
                                    (GMT+05:45)
                                    Kathmandu
                                </option>
                                <option value="Asia/Almaty" <?php echo e($tz?($tz=='Asia/Almaty'?'selected':''):''); ?>>(GMT+06:00)
                                    Almaty,
                                    Novosibirsk
                                </option>
                                <option value="Asia/Dhaka" <?php echo e($tz?($tz=='Asia/Dhaka'?'selected':''):''); ?>>(GMT+06:00)
                                    Astana,
                                    Dhaka
                                </option>
                                <option value="Asia/Rangoon" <?php echo e($tz?($tz=='Asia/Rangoon'?'selected':''):''); ?>>(GMT+06:30)
                                    Yangon
                                    (Rangoon)
                                </option>
                                <option value="Asia/Bangkok" <?php echo e($tz?($tz=='"Asia/Bangkok'?'selected':''):''); ?>>(GMT+07:00)
                                    Bangkok, Hanoi, Jakarta
                                </option>
                                <option value="Asia/Krasnoyarsk" <?php echo e($tz?($tz=='Asia/Krasnoyarsk'?'selected':''):''); ?>>
                                    (GMT+07:00)
                                    Krasnoyarsk
                                </option>
                                <option value="Asia/Hong_Kong" <?php echo e($tz?($tz=='Asia/Hong_Kong'?'selected':''):''); ?>>
                                    (GMT+08:00)
                                    Beijing, Chongqing, Hong Kong, Urumqi
                                </option>
                                <option value="Asia/Kuala_Lumpur" <?php echo e($tz?($tz=='Asia/Kuala_Lumpur'?'selected':''):''); ?>>
                                    (GMT+08:00) Kuala Lumpur, Singapore
                                </option>
                                <option value="Asia/Irkutsk" <?php echo e($tz?($tz=='Asia/Irkutsk'?'selected':''):''); ?>>(GMT+08:00)
                                    Irkutsk,
                                    Ulaan Bataar
                                </option>
                                <option value="Australia/Perth" <?php echo e($tz?($tz=='Australia/Perth'?'selected':''):''); ?>>
                                    (GMT+08:00)
                                    Perth
                                </option>
                                <option value="Asia/Taipei" <?php echo e($tz?($tz=='Asia/Taipei'?'selected':''):''); ?>>(GMT+08:00)
                                    Taipei
                                </option>
                                <option value="Asia/Tokyo" <?php echo e($tz?($tz=='Asia/Tokyo'?'selected':''):''); ?>>(GMT+09:00)
                                    Osaka,
                                    Sapporo, Tokyo
                                </option>
                                <option value="Asia/Seoul" <?php echo e($tz?($tz=='Asia/Seoul'?'selected':''):''); ?>>(GMT+09:00)
                                    Seoul
                                </option>
                                <option value="Asia/Yakutsk" <?php echo e($tz?($tz=='Asia/Yakutsk'?'selected':''):''); ?>>(GMT+09:00)
                                    Yakutsk
                                </option>
                                <option value="Australia/Adelaide" <?php echo e($tz?($tz=='Australia/Adelaide'?'selected':''):''); ?>>
                                    (GMT+09:30) Adelaide
                                </option>
                                <option value="Australia/Darwin" <?php echo e($tz?($tz=='Australia/Darwin'?'selected':''):''); ?>>
                                    (GMT+09:30)
                                    Darwin
                                </option>
                                <option value="Australia/Brisbane" <?php echo e($tz?($tz=='Australia/Brisbane'?'selected':''):''); ?>>
                                    (GMT+10:00) Brisbane
                                </option>
                                <option value="Australia/Canberra" <?php echo e($tz?($tz=='Australia/Canberra'?'selected':''):''); ?>>
                                    (GMT+10:00) Canberra, Melbourne, Sydney
                                </option>
                                <option value="Australia/Hobart" <?php echo e($tz?($tz=='Australia/Hobart'?'selected':''):''); ?>>
                                    (GMT+10:00)
                                    Hobart
                                </option>
                                <option value="Pacific/Guam" <?php echo e($tz?($tz=='Pacific/Guam'?'selected':''):''); ?>>(GMT+10:00)
                                    Guam,
                                    Port Moresby
                                </option>
                                <option value="Asia/Vladivostok" <?php echo e($tz?($tz=='Asia/Vladivostok'?'selected':''):''); ?>>
                                    (GMT+10:00)
                                    Vladivostok
                                </option>
                                <option value="Asia/Magadan" <?php echo e($tz?($tz=='Asia/Magadan'?'selected':''):''); ?>>(GMT+11:00)
                                    Magadan,
                                    Solomon Is., New Caledonia
                                </option>
                                <option value="Pacific/Auckland" <?php echo e($tz?($tz=='Pacific/Auckland'?'selected':''):''); ?>>
                                    (GMT+12:00)
                                    Auckland, Wellington
                                </option>
                                <option value="Pacific/Fiji" <?php echo e($tz?($tz=='Pacific/Fiji'?'selected':''):''); ?>>(GMT+12:00)
                                    Fiji,
                                    Kamchatka, Marshall Is.
                                </option>
                                <option value="Pacific/Tongatapu" <?php echo e($tz?($tz=='Pacific/Tongatapu'?'selected':''):''); ?>>
                                    (GMT+13:00) Nuku'alofa
                                </option>
                            </select>
                        </div>
                    </div>
                    <?php ($cc=\App\Model\BusinessSetting::where('type','country_code')->first()); ?>
                    <?php ($cc=$cc?$cc->value:0); ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label
                                class="input-label d-inline text-capitalize"><?php echo e(\App\CPU\translate('country')); ?> </label>
                            <select id="country" name="country" class="form-control  js-select2-custom">
                                <option value="AF" <?php echo e($cc?($cc=='AF'?'selected':''):''); ?> >Afghanistan</option>
                                <option value="AX" <?php echo e($cc?($cc=='AX'?'selected':''):''); ?> >Åland Islands</option>
                                <option value="AL" <?php echo e($cc?($cc=='AL'?'selected':''):''); ?> >Albania</option>
                                <option value="DZ" <?php echo e($cc?($cc=='DZ'?'selected':''):''); ?>>Algeria</option>
                                <option value="AS" <?php echo e($cc?($cc=='AS'?'selected':''):''); ?>>American Samoa</option>
                                <option value="AD" <?php echo e($cc?($cc=='AD'?'selected':''):''); ?>>Andorra</option>
                                <option value="AO" <?php echo e($cc?($cc=='AO'?'selected':''):''); ?>>Angola</option>
                                <option value="AI" <?php echo e($cc?($cc=='AI'?'selected':''):''); ?>>Anguilla</option>
                                <option value="AQ" <?php echo e($cc?($cc=='AQ'?'selected':''):''); ?>>Antarctica</option>
                                <option value="AG" <?php echo e($cc?($cc=='AG'?'selected':''):''); ?>>Antigua and Barbuda</option>
                                <option value="AR" <?php echo e($cc?($cc=='AR'?'selected':''):''); ?>>Argentina</option>
                                <option value="AM" <?php echo e($cc?($cc=='AM'?'selected':''):''); ?>>Armenia</option>
                                <option value="AW" <?php echo e($cc?($cc=='AW'?'selected':''):''); ?>>Aruba</option>
                                <option value="AU" <?php echo e($cc?($cc=='AU'?'selected':''):''); ?>>Australia</option>
                                <option value="AT" <?php echo e($cc?($cc=='AT'?'selected':''):''); ?>>Austria</option>
                                <option value="AZ" <?php echo e($cc?($cc=='AZ'?'selected':''):''); ?>>Azerbaijan</option>
                                <option value="BS" <?php echo e($cc?($cc=='BS'?'selected':''):''); ?>>Bahamas</option>
                                <option value="BH" <?php echo e($cc?($cc=='BH'?'selected':''):''); ?>>Bahrain</option>
                                <option value="BD" <?php echo e($cc?($cc=='BD'?'selected':''):''); ?>>Bangladesh</option>
                                <option value="BB" <?php echo e($cc?($cc=='BB'?'selected':''):''); ?>>Barbados</option>
                                <option value="BY" <?php echo e($cc?($cc=='BY'?'selected':''):''); ?>>Belarus</option>
                                <option value="BE" <?php echo e($cc?($cc=='BE'?'selected':''):''); ?>>Belgium</option>
                                <option value="BZ" <?php echo e($cc?($cc=='BZ'?'selected':''):''); ?>>Belize</option>
                                <option value="BJ" <?php echo e($cc?($cc=='BJ'?'selected':''):''); ?>>Benin</option>
                                <option value="BM" <?php echo e($cc?($cc=='BM'?'selected':''):''); ?>>Bermuda</option>
                                <option value="BT" <?php echo e($cc?($cc=='BT'?'selected':''):''); ?>>Bhutan</option>
                                <option value="BO" <?php echo e($cc?($cc=='BO'?'selected':''):''); ?>>Bolivia, Plurinational State
                                    of
                                </option>
                                <option value="BQ" <?php echo e($cc?($cc=='BQ'?'selected':''):''); ?>>Bonaire, Sint Eustatius and
                                    Saba
                                </option>
                                <option value="BA" <?php echo e($cc?($cc=='BA'?'selected':''):''); ?>>Bosnia and Herzegovina
                                </option>
                                <option value="BW" <?php echo e($cc?($cc=='BW'?'selected':''):''); ?>>Botswana</option>
                                <option value="BV" <?php echo e($cc?($cc=='BV'?'selected':''):''); ?>>Bouvet Island</option>
                                <option value="BR" <?php echo e($cc?($cc=='BR'?'selected':''):''); ?>>Brazil</option>
                                <option value="IO" <?php echo e($cc?($cc=='IO'?'selected':''):''); ?>>British Indian Ocean
                                    Territory
                                </option>
                                <option value="BN" <?php echo e($cc?($cc=='BN'?'selected':''):''); ?>>Brunei Darussalam</option>
                                <option value="BG" <?php echo e($cc?($cc=='BG'?'selected':''):''); ?>>Bulgaria</option>
                                <option value="BF" <?php echo e($cc?($cc=='BF'?'selected':''):''); ?>>Burkina Faso</option>
                                <option value="BI" <?php echo e($cc?($cc=='BI'?'selected':''):''); ?>>Burundi</option>
                                <option value="KH" <?php echo e($cc?($cc=='KH'?'selected':''):''); ?>>Cambodia</option>
                                <option value="CM" <?php echo e($cc?($cc=='CM'?'selected':''):''); ?>>Cameroon</option>
                                <option value="CA" <?php echo e($cc?($cc=='CA'?'selected':''):''); ?>>Canada</option>
                                <option value="CV" <?php echo e($cc?($cc=='CV'?'selected':''):''); ?>>Cape Verde</option>
                                <option value="KY" <?php echo e($cc?($cc=='KY'?'selected':''):''); ?>>Cayman Islands</option>
                                <option value="CF" <?php echo e($cc?($cc=='CF'?'selected':''):''); ?>>Central African Republic
                                </option>
                                <option value="TD" <?php echo e($cc?($cc=='TD'?'selected':''):''); ?>>Chad</option>
                                <option value="CL" <?php echo e($cc?($cc=='CL'?'selected':''):''); ?>>Chile</option>
                                <option value="CN" <?php echo e($cc?($cc=='CN'?'selected':''):''); ?>>China</option>
                                <option value="CX" <?php echo e($cc?($cc=='CX'?'selected':''):''); ?>>Christmas Island</option>
                                <option value="CC" <?php echo e($cc?($cc=='CC'?'selected':''):''); ?>>Cocos (Keeling) Islands
                                </option>
                                <option value="CO" <?php echo e($cc?($cc=='CO'?'selected':''):''); ?>>Colombia</option>
                                <option value="KM" <?php echo e($cc?($cc=='KM'?'selected':''):''); ?>>Comoros</option>
                                <option value="CG" <?php echo e($cc?($cc=='CG'?'selected':''):''); ?>>Congo</option>
                                <option value="CD" <?php echo e($cc?($cc=='CD'?'selected':''):''); ?>>Congo, the Democratic Republic
                                    of the
                                </option>
                                <option value="CK" <?php echo e($cc?($cc=='CK'?'selected':''):''); ?>>Cook Islands</option>
                                <option value="CR" <?php echo e($cc?($cc=='CR'?'selected':''):''); ?>>Costa Rica</option>
                                <option value="CI" <?php echo e($cc?($cc=='CI'?'selected':''):''); ?>>Côte d'Ivoire</option>
                                <option value="HR" <?php echo e($cc?($cc=='HR'?'selected':''):''); ?>>Croatia</option>
                                <option value="CU" <?php echo e($cc?($cc=='CU'?'selected':''):''); ?>>Cuba</option>
                                <option value="CW" <?php echo e($cc?($cc=='CW'?'selected':''):''); ?>>Curaçao</option>
                                <option value="CY" <?php echo e($cc?($cc=='CY'?'selected':''):''); ?>>Cyprus</option>
                                <option value="CZ" <?php echo e($cc?($cc=='CZ'?'selected':''):''); ?>>Czech Republic</option>
                                <option value="DK" <?php echo e($cc?($cc=='DK'?'selected':''):''); ?>>Denmark</option>
                                <option value="DJ" <?php echo e($cc?($cc=='DJ'?'selected':''):''); ?>>Djibouti</option>
                                <option value="DM" <?php echo e($cc?($cc=='DM'?'selected':''):''); ?>>Dominica</option>
                                <option value="DO" <?php echo e($cc?($cc=='DO'?'selected':''):''); ?>>Dominican Republic</option>
                                <option value="EC" <?php echo e($cc?($cc=='EC'?'selected':''):''); ?>>Ecuador</option>
                                <option value="EG" <?php echo e($cc?($cc=='EG'?'selected':''):''); ?>>Egypt</option>
                                <option value="SV" <?php echo e($cc?($cc=='SV'?'selected':''):''); ?>>El Salvador</option>
                                <option value="GQ" <?php echo e($cc?($cc=='GQ'?'selected':''):''); ?>>Equatorial Guinea</option>
                                <option value="ER" <?php echo e($cc?($cc=='ER'?'selected':''):''); ?>>Eritrea</option>
                                <option value="EE" <?php echo e($cc?($cc=='EE'?'selected':''):''); ?>>Estonia</option>
                                <option value="ET" <?php echo e($cc?($cc=='ET'?'selected':''):''); ?>>Ethiopia</option>
                                <option value="FK" <?php echo e($cc?($cc=='FK'?'selected':''):''); ?>>Falkland Islands (Malvinas)
                                </option>
                                <option value="FO" <?php echo e($cc?($cc=='FO'?'selected':''):''); ?>>Faroe Islands</option>
                                <option value="FJ" <?php echo e($cc?($cc=='FJ'?'selected':''):''); ?>>Fiji</option>
                                <option value="FI" <?php echo e($cc?($cc=='FI'?'selected':''):''); ?>>Finland</option>
                                <option value="FR" <?php echo e($cc?($cc=='FR'?'selected':''):''); ?>>France</option>
                                <option value="GF" <?php echo e($cc?($cc=='GF'?'selected':''):''); ?>>French Guiana</option>
                                <option value="PF" <?php echo e($cc?($cc=='PF'?'selected':''):''); ?>>French Polynesia</option>
                                <option value="TF" <?php echo e($cc?($cc=='TF'?'selected':''):''); ?>>French Southern Territories
                                </option>
                                <option value="GA" <?php echo e($cc?($cc=='GA'?'selected':''):''); ?>>Gabon</option>
                                <option value="GM" <?php echo e($cc?($cc=='GM'?'selected':''):''); ?>>Gambia</option>
                                <option value="GE" <?php echo e($cc?($cc=='GE'?'selected':''):''); ?>>Georgia</option>
                                <option value="DE" <?php echo e($cc?($cc=='DE'?'selected':''):''); ?>>Germany</option>
                                <option value="GH" <?php echo e($cc?($cc=='GH'?'selected':''):''); ?>>Ghana</option>
                                <option value="GI" <?php echo e($cc?($cc=='GI'?'selected':''):''); ?>>Gibraltar</option>
                                <option value="GR" <?php echo e($cc?($cc=='GR'?'selected':''):''); ?>>Greece</option>
                                <option value="GL" <?php echo e($cc?($cc=='GL'?'selected':''):''); ?>>Greenland</option>
                                <option value="GD" <?php echo e($cc?($cc=='GD'?'selected':''):''); ?>>Grenada</option>
                                <option value="GP" <?php echo e($cc?($cc=='GP'?'selected':''):''); ?>>Guadeloupe</option>
                                <option value="GU" <?php echo e($cc?($cc=='GU'?'selected':''):''); ?>>Guam</option>
                                <option value="GT" <?php echo e($cc?($cc=='GT'?'selected':''):''); ?>>Guatemala</option>
                                <option value="GG" <?php echo e($cc?($cc=='GG'?'selected':''):''); ?>>Guernsey</option>
                                <option value="GN" <?php echo e($cc?($cc=='GN'?'selected':''):''); ?>>Guinea</option>
                                <option value="GW" <?php echo e($cc?($cc=='GW'?'selected':''):''); ?>>Guinea-Bissau</option>
                                <option value="GY" <?php echo e($cc?($cc=='GY'?'selected':''):''); ?>>Guyana</option>
                                <option value="HT" <?php echo e($cc?($cc=='HT'?'selected':''):''); ?>>Haiti</option>
                                <option value="HM" <?php echo e($cc?($cc=='HM'?'selected':''):''); ?>>Heard Island and McDonald
                                    Islands
                                </option>
                                <option value="VA" <?php echo e($cc?($cc=='VA'?'selected':''):''); ?>>Holy See (Vatican City
                                    State)
                                </option>
                                <option value="HN" <?php echo e($cc?($cc=='HN'?'selected':''):''); ?>>Honduras</option>
                                <option value="HK" <?php echo e($cc?($cc=='HK'?'selected':''):''); ?>>Hong Kong</option>
                                <option value="HU" <?php echo e($cc?($cc=='HU'?'selected':''):''); ?>>Hungary</option>
                                <option value="IS" <?php echo e($cc?($cc=='IS'?'selected':''):''); ?>>Iceland</option>
                                <option value="IN" <?php echo e($cc?($cc=='IN'?'selected':''):''); ?>>India</option>
                                <option value="ID" <?php echo e($cc?($cc=='ID'?'selected':''):''); ?>>Indonesia</option>
                                <option value="IR" <?php echo e($cc?($cc=='IR'?'selected':''):''); ?>>Iran, Islamic Republic of
                                </option>
                                <option value="IQ" <?php echo e($cc?($cc=='IQ'?'selected':''):''); ?>>Iraq</option>
                                <option value="IE" <?php echo e($cc?($cc=='IE'?'selected':''):''); ?>>Ireland</option>
                                <option value="IM" <?php echo e($cc?($cc=='IM'?'selected':''):''); ?>>Isle of Man</option>
                                <option value="IL" <?php echo e($cc?($cc=='IL'?'selected':''):''); ?>>Israel</option>
                                <option value="IT" <?php echo e($cc?($cc=='IT'?'selected':''):''); ?>>Italy</option>
                                <option value="JM" <?php echo e($cc?($cc=='JM'?'selected':''):''); ?>>Jamaica</option>
                                <option value="JP" <?php echo e($cc?($cc=='JP'?'selected':''):''); ?>>Japan</option>
                                <option value="JE" <?php echo e($cc?($cc=='JE'?'selected':''):''); ?>>Jersey</option>
                                <option value="JO" <?php echo e($cc?($cc=='JO'?'selected':''):''); ?>>Jordan</option>
                                <option value="KZ" <?php echo e($cc?($cc=='KZ'?'selected':''):''); ?>>Kazakhstan</option>
                                <option value="KE" <?php echo e($cc?($cc=='KE'?'selected':''):''); ?>>Kenya</option>
                                <option value="KI" <?php echo e($cc?($cc=='KI'?'selected':''):''); ?>>Kiribati</option>
                                <option value="KP" <?php echo e($cc?($cc=='KP'?'selected':''):''); ?>>Korea, Democratic People's
                                    Republic of
                                </option>
                                <option value="KR" <?php echo e($cc?($cc=='KR'?'selected':''):''); ?>>Korea, Republic of</option>
                                <option value="KW" <?php echo e($cc?($cc=='KW'?'selected':''):''); ?>>Kuwait</option>
                                <option value="KG" <?php echo e($cc?($cc=='KG'?'selected':''):''); ?>>Kyrgyzstan</option>
                                <option value="LA" <?php echo e($cc?($cc=='LA'?'selected':''):''); ?>>Lao People's Democratic
                                    Republic
                                </option>
                                <option value="LV" <?php echo e($cc?($cc=='LV'?'selected':''):''); ?>>Latvia</option>
                                <option value="LB" <?php echo e($cc?($cc=='LB'?'selected':''):''); ?>>Lebanon</option>
                                <option value="LS" <?php echo e($cc?($cc=='LS'?'selected':''):''); ?>>Lesotho</option>
                                <option value="LR" <?php echo e($cc?($cc=='LR'?'selected':''):''); ?>>Liberia</option>
                                <option value="LY" <?php echo e($cc?($cc=='LY'?'selected':''):''); ?>>Libya</option>
                                <option value="LI" <?php echo e($cc?($cc=='LI'?'selected':''):''); ?>>Liechtenstein</option>
                                <option value="LT" <?php echo e($cc?($cc=='LT'?'selected':''):''); ?>>Lithuania</option>
                                <option value="LU" <?php echo e($cc?($cc=='LU'?'selected':''):''); ?>>Luxembourg</option>
                                <option value="MO" <?php echo e($cc?($cc=='MO'?'selected':''):''); ?>>Macao</option>
                                <option value="MK" <?php echo e($cc?($cc=='MK'?'selected':''):''); ?>>Macedonia, the former Yugoslav
                                    Republic of
                                </option>
                                <option value="MG" <?php echo e($cc?($cc=='MG'?'selected':''):''); ?>>Madagascar</option>
                                <option value="MW" <?php echo e($cc?($cc=='MW'?'selected':''):''); ?>>Malawi</option>
                                <option value="MY" <?php echo e($cc?($cc=='MY'?'selected':''):''); ?>>Malaysia</option>
                                <option value="MV" <?php echo e($cc?($cc=='MV'?'selected':''):''); ?>>Maldives</option>
                                <option value="ML" <?php echo e($cc?($cc=='ML'?'selected':''):''); ?>>Mali</option>
                                <option value="MT" <?php echo e($cc?($cc=='MT'?'selected':''):''); ?>>Malta</option>
                                <option value="MH" <?php echo e($cc?($cc=='MH'?'selected':''):''); ?>>Marshall Islands</option>
                                <option value="MQ" <?php echo e($cc?($cc=='MQ'?'selected':''):''); ?>>Martinique</option>
                                <option value="MR" <?php echo e($cc?($cc=='MR'?'selected':''):''); ?>>Mauritania</option>
                                <option value="MU" <?php echo e($cc?($cc=='MU'?'selected':''):''); ?>>Mauritius</option>
                                <option value="YT" <?php echo e($cc?($cc=='YT'?'selected':''):''); ?>>Mayotte</option>
                                <option value="MX" <?php echo e($cc?($cc=='MX'?'selected':''):''); ?>>Mexico</option>
                                <option value="FM" <?php echo e($cc?($cc=='FM'?'selected':''):''); ?>>Micronesia, Federated States
                                    of
                                </option>
                                <option value="MD" <?php echo e($cc?($cc=='MD'?'selected':''):''); ?>>Moldova, Republic of</option>
                                <option value="MC" <?php echo e($cc?($cc=='MC'?'selected':''):''); ?>>Monaco</option>
                                <option value="MN" <?php echo e($cc?($cc=='MN'?'selected':''):''); ?>>Mongolia</option>
                                <option value="ME" <?php echo e($cc?($cc=='ME'?'selected':''):''); ?>>Montenegro</option>
                                <option value="MS" <?php echo e($cc?($cc=='MS'?'selected':''):''); ?>>Montserrat</option>
                                <option value="MA" <?php echo e($cc?($cc=='MA'?'selected':''):''); ?>>Morocco</option>
                                <option value="MZ" <?php echo e($cc?($cc=='MZ'?'selected':''):''); ?>>Mozambique</option>
                                <option value="MM" <?php echo e($cc?($cc=='MM'?'selected':''):''); ?>>Myanmar</option>
                                <option value="NA" <?php echo e($cc?($cc=='NA'?'selected':''):''); ?>>Namibia</option>
                                <option value="NR" <?php echo e($cc?($cc=='NR'?'selected':''):''); ?>>Nauru</option>
                                <option value="NP" <?php echo e($cc?($cc=='NP'?'selected':''):''); ?>>Nepal</option>
                                <option value="NL" <?php echo e($cc?($cc=='NL'?'selected':''):''); ?>>Netherlands</option>
                                <option value="NC" <?php echo e($cc?($cc=='NC'?'selected':''):''); ?>>New Caledonia</option>
                                <option value="NZ" <?php echo e($cc?($cc=='NZ'?'selected':''):''); ?>>New Zealand</option>
                                <option value="NI" <?php echo e($cc?($cc=='NI'?'selected':''):''); ?>>Nicaragua</option>
                                <option value="NE" <?php echo e($cc?($cc=='NE'?'selected':''):''); ?>>Niger</option>
                                <option value="NG" <?php echo e($cc?($cc=='NG'?'selected':''):''); ?>>Nigeria</option>
                                <option value="NU" <?php echo e($cc?($cc=='NU'?'selected':''):''); ?>>Niue</option>
                                <option value="NF" <?php echo e($cc?($cc=='NF'?'selected':''):''); ?>>Norfolk Island</option>
                                <option value="MP" <?php echo e($cc?($cc=='MP'?'selected':''):''); ?>>Northern Mariana Islands
                                </option>
                                <option value="NO" <?php echo e($cc?($cc=='NO'?'selected':''):''); ?>>Norway</option>
                                <option value="OM" <?php echo e($cc?($cc=='OM'?'selected':''):''); ?>>Oman</option>
                                <option value="PK" <?php echo e($cc?($cc=='PK'?'selected':''):''); ?>>Pakistan</option>
                                <option value="PW" <?php echo e($cc?($cc=='PW'?'selected':''):''); ?>>Palau</option>
                                <option value="PS" <?php echo e($cc?($cc=='PS'?'selected':''):''); ?>>Palestinian Territory,
                                    Occupied
                                </option>
                                <option value="PA" <?php echo e($cc?($cc=='PA'?'selected':''):''); ?>>Panama</option>
                                <option value="PG" <?php echo e($cc?($cc=='PG'?'selected':''):''); ?>>Papua New Guinea</option>
                                <option value="PY" <?php echo e($cc?($cc=='PY'?'selected':''):''); ?>>Paraguay</option>
                                <option value="PE" <?php echo e($cc?($cc=='PE'?'selected':''):''); ?>>Peru</option>
                                <option value="PH" <?php echo e($cc?($cc=='PH'?'selected':''):''); ?>>Philippines</option>
                                <option value="PN" <?php echo e($cc?($cc=='PN'?'selected':''):''); ?>>Pitcairn</option>
                                <option value="PL" <?php echo e($cc?($cc=='PL'?'selected':''):''); ?>>Poland</option>
                                <option value="PT" <?php echo e($cc?($cc=='PT'?'selected':''):''); ?>>Portugal</option>
                                <option value="PR" <?php echo e($cc?($cc=='PR'?'selected':''):''); ?>>Puerto Rico</option>
                                <option value="QA" <?php echo e($cc?($cc=='QA'?'selected':''):''); ?>>Qatar</option>
                                <option value="RE" <?php echo e($cc?($cc=='RE'?'selected':''):''); ?>>Réunion</option>
                                <option value="RO" <?php echo e($cc?($cc=='RO'?'selected':''):''); ?>>Romania</option>
                                <option value="RU" <?php echo e($cc?($cc=='RU'?'selected':''):''); ?>>Russian Federation</option>
                                <option value="RW" <?php echo e($cc?($cc=='RW'?'selected':''):''); ?>>Rwanda</option>
                                <option value="BL" <?php echo e($cc?($cc=='BL'?'selected':''):''); ?>>Saint Barthélemy</option>
                                <option value="SH" <?php echo e($cc?($cc=='SH'?'selected':''):''); ?>>Saint Helena, Ascension and
                                    Tristan da Cunha
                                </option>
                                <option value="KN" <?php echo e($cc?($cc=='KN'?'selected':''):''); ?>>Saint Kitts and Nevis</option>
                                <option value="LC" <?php echo e($cc?($cc=='LC'?'selected':''):''); ?>>Saint Lucia</option>
                                <option value="MF" <?php echo e($cc?($cc=='MF'?'selected':''):''); ?>>Saint Martin (French part)
                                </option>
                                <option value="PM" <?php echo e($cc?($cc=='PM'?'selected':''):''); ?>>Saint Pierre and Miquelon
                                </option>
                                <option value="VC" <?php echo e($cc?($cc=='VC'?'selected':''):''); ?>>Saint Vincent and the
                                    Grenadines
                                </option>
                                <option value="WS" <?php echo e($cc?($cc=='WS'?'selected':''):''); ?>>Samoa</option>
                                <option value="SM" <?php echo e($cc?($cc=='SM'?'selected':''):''); ?>>San Marino</option>
                                <option value="ST" <?php echo e($cc?($cc=='ST'?'selected':''):''); ?>>Sao Tome and Principe</option>
                                <option value="SA" <?php echo e($cc?($cc=='SA'?'selected':''):''); ?>>Saudi Arabia</option>
                                <option value="SN" <?php echo e($cc?($cc=='SN'?'selected':''):''); ?>>Senegal</option>
                                <option value="RS" <?php echo e($cc?($cc=='RS'?'selected':''):''); ?>>Serbia</option>
                                <option value="SC" <?php echo e($cc?($cc=='SC'?'selected':''):''); ?>>Seychelles</option>
                                <option value="SL" <?php echo e($cc?($cc=='SL'?'selected':''):''); ?>>Sierra Leone</option>
                                <option value="SG" <?php echo e($cc?($cc=='SG'?'selected':''):''); ?>>Singapore</option>
                                <option value="SX" <?php echo e($cc?($cc=='SX'?'selected':''):''); ?>>Sint Maarten (Dutch part)
                                </option>
                                <option value="SK" <?php echo e($cc?($cc=='SK'?'selected':''):''); ?>>Slovakia</option>
                                <option value="SI" <?php echo e($cc?($cc=='SI'?'selected':''):''); ?>>Slovenia</option>
                                <option value="SB" <?php echo e($cc?($cc=='SB'?'selected':''):''); ?>>Solomon Islands</option>
                                <option value="SO" <?php echo e($cc?($cc=='SO'?'selected':''):''); ?>>Somalia</option>
                                <option value="ZA" <?php echo e($cc?($cc=='ZA'?'selected':''):''); ?>>South Africa</option>
                                <option value="GS" <?php echo e($cc?($cc=='GS'?'selected':''):''); ?>>South Georgia and the South
                                    Sandwich Islands
                                </option>
                                <option value="SS" <?php echo e($cc?($cc=='SS'?'selected':''):''); ?>>South Sudan</option>
                                <option value="ES" <?php echo e($cc?($cc=='ES'?'selected':''):''); ?>>Spain</option>
                                <option value="LK" <?php echo e($cc?($cc=='LK'?'selected':''):''); ?>>Sri Lanka</option>
                                <option value="SD" <?php echo e($cc?($cc=='SD'?'selected':''):''); ?>>Sudan</option>
                                <option value="SR" <?php echo e($cc?($cc=='SR'?'selected':''):''); ?>>Suriname</option>
                                <option value="SJ" <?php echo e($cc?($cc=='SJ'?'selected':''):''); ?>>Svalbard and Jan Mayen
                                </option>
                                <option value="SZ" <?php echo e($cc?($cc=='SZ'?'selected':''):''); ?>>Swaziland</option>
                                <option value="SE" <?php echo e($cc?($cc=='SE'?'selected':''):''); ?>>Sweden</option>
                                <option value="CH" <?php echo e($cc?($cc=='CH'?'selected':''):''); ?>>Switzerland</option>
                                <option value="SY" <?php echo e($cc?($cc=='SY'?'selected':''):''); ?>>Syrian Arab Republic</option>
                                <option value="TW" <?php echo e($cc?($cc=='TW'?'selected':''):''); ?>>Taiwan, Province of China
                                </option>
                                <option value="TJ" <?php echo e($cc?($cc=='TJ'?'selected':''):''); ?>>Tajikistan</option>
                                <option value="TZ" <?php echo e($cc?($cc=='TZ'?'selected':''):''); ?>>Tanzania, United Republic of
                                </option>
                                <option value="TH" <?php echo e($cc?($cc=='TH'?'selected':''):''); ?>>Thailand</option>
                                <option value="TL" <?php echo e($cc?($cc=='TL'?'selected':''):''); ?>>Timor-Leste</option>
                                <option value="TG" <?php echo e($cc?($cc=='TG'?'selected':''):''); ?>>Togo</option>
                                <option value="TK" <?php echo e($cc?($cc=='TK'?'selected':''):''); ?>>Tokelau</option>
                                <option value="TO" <?php echo e($cc?($cc=='TO'?'selected':''):''); ?>>Tonga</option>
                                <option value="TT" <?php echo e($cc?($cc=='TT'?'selected':''):''); ?>>Trinidad and Tobago</option>
                                <option value="TN" <?php echo e($cc?($cc=='TN'?'selected':''):''); ?>>Tunisia</option>
                                <option value="TR" <?php echo e($cc?($cc=='TR'?'selected':''):''); ?>>Turkey</option>
                                <option value="TM" <?php echo e($cc?($cc=='TM'?'selected':''):''); ?>>Turkmenistan</option>
                                <option value="TC" <?php echo e($cc?($cc=='TC'?'selected':''):''); ?>>Turks and Caicos Islands
                                </option>
                                <option value="TV" <?php echo e($cc?($cc=='TV'?'selected':''):''); ?>>Tuvalu</option>
                                <option value="UG" <?php echo e($cc?($cc=='UG'?'selected':''):''); ?>>Uganda</option>
                                <option value="UA" <?php echo e($cc?($cc=='UA'?'selected':''):''); ?>>Ukraine</option>
                                <option value="AE" <?php echo e($cc?($cc=='AE'?'selected':''):''); ?>>United Arab Emirates</option>
                                <option value="GB" <?php echo e($cc?($cc=='GB'?'selected':''):''); ?>>United Kingdom</option>
                                <option value="US" <?php echo e($cc?($cc=='US'?'selected':''):''); ?>>United States</option>
                                <option value="UM" <?php echo e($cc?($cc=='UM'?'selected':''):''); ?>>United States Minor Outlying
                                    Islands
                                </option>
                                <option value="UY" <?php echo e($cc?($cc=='UY'?'selected':''):''); ?>>Uruguay</option>
                                <option value="UZ" <?php echo e($cc?($cc=='UZ'?'selected':''):''); ?>>Uzbekistan</option>
                                <option value="VU" <?php echo e($cc?($cc=='VU'?'selected':''):''); ?>>Vanuatu</option>
                                <option value="VE" <?php echo e($cc?($cc=='VE'?'selected':''):''); ?>>Venezuela, Bolivarian Republic
                                    of
                                </option>
                                <option value="VN" <?php echo e($cc?($cc=='VN'?'selected':''):''); ?>>Viet Nam</option>
                                <option value="VG" <?php echo e($cc?($cc=='VG'?'selected':''):''); ?>>Virgin Islands, British
                                </option>
                                <option value="VI" <?php echo e($cc?($cc=='VI'?'selected':''):''); ?>>Virgin Islands, U.S.</option>
                                <option value="WF" <?php echo e($cc?($cc=='WF'?'selected':''):''); ?>>Wallis and Futuna</option>
                                <option value="EH" <?php echo e($cc?($cc=='EH'?'selected':''):''); ?>>Western Sahara</option>
                                <option value="YE" <?php echo e($cc?($cc=='YE'?'selected':''):''); ?>>Yemen</option>
                                <option value="ZM" <?php echo e($cc?($cc=='ZM'?'selected':''):''); ?>>Zambia</option>
                                <option value="ZW" <?php echo e($cc?($cc=='ZW'?'selected':''):''); ?>>Zimbabwe</option>
                            </select>
                        </div>
                    </div>

                    <?php ($fpv=\App\CPU\Helpers::get_business_settings('forgot_password_verification')); ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label
                                class="input-label d-inline text-capitalize"><?php echo e(\App\CPU\translate('forgot_password_verification_by')); ?> </label>
                            <select name="forgot_password_verification" class="form-control  js-select2-custom">
                                <option value="email" <?php echo e(isset($fpv)?($fpv=='email'?'selected':''):''); ?> >Email</option>
                                <option value="phone" <?php echo e(isset($fpv)?($fpv=='phone'?'selected':''):''); ?> >Phone</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12">
                        <?php ($pv=\App\CPU\Helpers::get_business_settings('phone_verification')); ?>
                        <div class="form-group">
                            <label><?php echo e(\App\CPU\translate('phone')); ?> <?php echo e(\App\CPU\translate('verification')); ?> ( OTP
                                )</label><small style="color: red">*</small>
                            <div class="input-group input-group-md-down-break">
                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="1"
                                               name="phone_verification"
                                               id="phone_verification_on" <?php echo e((isset($pv) && $pv==1)?'checked':''); ?>>
                                        <label class="custom-control-label"
                                               for="phone_verification_on"><?php echo e(\App\CPU\translate('on')); ?></label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->

                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="0"
                                               name="phone_verification"
                                               id="phone_verification_off" <?php echo e((isset($pv) && $pv==0)?'checked':''); ?>>
                                        <label class="custom-control-label"
                                               for="phone_verification_off"><?php echo e(\App\CPU\translate('off')); ?></label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <?php ($ev=\App\CPU\Helpers::get_business_settings('email_verification')); ?>
                        <div class="form-group">
                            <label><?php echo e(\App\CPU\translate('email')); ?> <?php echo e(\App\CPU\translate('verification')); ?></label><small
                                style="color: red">*</small>
                            <div class="input-group input-group-md-down-break">
                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="1"
                                               name="email_verification"
                                               id="email_verification_on" <?php echo e($ev==1?'checked':''); ?>>
                                        <label class="custom-control-label"
                                               for="email_verification_on"><?php echo e(\App\CPU\translate('on')); ?></label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->

                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="0"
                                               name="email_verification"
                                               id="email_verification_off" <?php echo e($ev==0?'checked':''); ?>>
                                        <label class="custom-control-label"
                                               for="email_verification_off"><?php echo e(\App\CPU\translate('off')); ?></label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <?php ($order_verification=\App\CPU\Helpers::get_business_settings('order_verification')); ?>
                        <div class="form-group">
                            <label><?php echo e(\App\CPU\translate('order')); ?> <?php echo e(\App\CPU\translate('verification')); ?></label><small
                                style="color: red">*</small>
                            <div class="input-group input-group-md-down-break">
                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="1"
                                               name="order_verification"
                                               id="order_verification1" <?php echo e($order_verification==1?'checked':''); ?>>
                                        <label class="custom-control-label"
                                               for="order_verification1"><?php echo e(\App\CPU\translate('on')); ?></label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->

                                <!-- Custom Radio -->
                                <div class="form-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="0"
                                               name="order_verification"
                                               id="order_verification2" <?php echo e($order_verification==0?'checked':''); ?>>
                                        <label class="custom-control-label"
                                               for="order_verification2"><?php echo e(\App\CPU\translate('off')); ?></label>
                                    </div>
                                </div>
                                <!-- End Custom Radio -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(\App\CPU\translate('Web')); ?> <?php echo e(\App\CPU\translate('logo')); ?> </h5>
                                <span class="badge badge-soft-danger">( 250x60 px )</span>
                            </div>
                            <div class="card-body" style="padding: 20px">
                                <center>
                                    <img width="200" height="60" id="viewerWL"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e(\App\Model\BusinessSetting::where(['type' => 'company_web_logo'])->pluck('value')[0]); ?>">
                                </center>
                                <hr>
                                <div class="row pl-4 pr-4">
                                    <div class="col-12" style="text-align: left">
                                        <input type="file" name="company_web_logo" id="customFileUploadWL"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileUploadWL"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(\App\CPU\translate('Mobile')); ?> <?php echo e(\App\CPU\translate('logo')); ?> </h5>
                                <span class="badge badge-soft-danger">( 100X60 px )</span>
                            </div>
                            <div class="card-body" style="padding: 20px">
                                <center>
                                    <img width="100" height="60" id="viewerML"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e(\App\Model\BusinessSetting::where(['type' => 'company_mobile_logo'])->pluck('value')[0]); ?>">
                                </center>
                                <hr>
                                <div class="row pl-4 pr-4">
                                    <div class="col-12" style="text-align: left">
                                        <input type="file" name="company_mobile_logo" id="customFileUploadML"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileUploadML"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(\App\CPU\translate('web_footer')); ?> <?php echo e(\App\CPU\translate('logo')); ?> </h5>
                                <span class="badge badge-soft-danger">( 250x60 px )</span>
                            </div>
                            <div class="card-body" style="padding: 20px">
                                <center>
                                    <img width="250" id="viewerWFL"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e(\App\Model\BusinessSetting::where(['type' => 'company_footer_logo'])->pluck('value')[0]); ?>">
                                </center>
                                <hr>
                                <div class="row pl-4 pr-4">
                                    <div class="col-12" style="text-align: left">
                                        <input type="file" name="company_footer_logo" id="customFileUploadWFL"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileUploadWFL"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(\App\CPU\translate('web_fav_icon')); ?> </h5>
                                <span class="badge badge-soft-danger">( ratio 1:1 )</span>
                            </div>
                            <div class="card-body" style="padding: 20px">
                                <center>
                                    <img width="60" id="viewerFI"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e(\App\Model\BusinessSetting::where(['type' => 'company_fav_icon'])->pluck('value')[0]); ?>">
                                </center>
                                <hr>
                                <div class="row pl-4 pr-4">
                                    <div class="col-12" style="text-align: left">
                                        <input type="file" name="company_fav_icon" id="customFileUploadFI"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileUploadFI"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(\App\CPU\translate('loader_gif')); ?> </h5>
                                <span class="badge badge-soft-danger">( <?php echo e(\App\CPU\translate('ratio')); ?> 1:1 )</span>
                            </div>
                            <div class="card-body" style="padding: 20px">
                                <center>
                                    <img width="60" id="viewerLoader"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e(\App\CPU\Helpers::get_business_settings('loader_gif')); ?>">
                                </center>
                                <hr>
                                <div class="row pl-4 pr-4">
                                    <div class="col-12" style="text-align: left">
                                        <input type="file" name="loader_gif" id="customFileUploadLoader"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileUploadLoader"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-bottom: 20px">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding: 20px">
                                <?php ($colors=\App\Model\BusinessSetting::where(['type'=>'colors'])->first()); ?>
                                <?php if(isset($colors)): ?>
                                    <?php ($data=json_decode($colors['value'])); ?>
                                <?php else: ?>
                                    <?php (\Illuminate\Support\Facades\DB::table('business_settings')->insert([
                                            'type'=>'colors',
                                            'value'=>json_encode(
                                                [
                                                    'primary'=>null,
                                                    'secondary'=>null,
                                                ])
                                        ])); ?>
                                    <?php ($colors=\App\Model\BusinessSetting::where(['type'=>'colors'])->first()); ?>
                                    <?php ($data=json_decode($colors['value'])); ?>
                                <?php endif; ?>
                                <h4><?php echo e(\App\CPU\translate('web_color_setup')); ?></h4>
                                <div class="form-group">
                                    <label><?php echo e(\App\CPU\translate('Primary')); ?></label>
                                    <input type="color" name="primary" value="<?php echo e($data->primary); ?>"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(\App\CPU\translate('Secondary')); ?></label>
                                    <input type="color" name="secondary" value="<?php echo e($data->secondary); ?>"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Submit')); ?></button>
            </form>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/tags-input.min.js"></script>
    <script src="<?php echo e(asset('public/assets/select2/js/select2.min.js')); ?>"></script>
    <script>

        $("#customFileUploadShop").change(function () {
            read_image(this, 'viewerShop');
        });

        $("#customFileUploadWL").change(function () {
            read_image(this, 'viewerWL');
        });

        $("#customFileUploadWFL").change(function () {
            read_image(this, 'viewerWFL');
        });

        $("#customFileUploadML").change(function () {
            read_image(this, 'viewerML');
        });

        $("#customFileUploadFI").change(function () {
            read_image(this, 'viewerFI');
        });

        $("#customFileUploadLoader").change(function () {
            read_image(this, 'viewerLoader');
        });

        function read_image(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });

    </script>
    <script>
        $(document).ready(function () {
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>

    <script>
        <?php ($language=\App\Model\BusinessSetting::where('type','pnc_language')->first()); ?>
        <?php ($language = $language->value ?? null); ?>
        let language = <?php echo e($language); ?>;
        $('#language').val(language);
    </script>


    <script>
        function maintenance_mode() {
            Swal.fire({
                title: '<?php echo e(\App\CPU\translate('Are you sure')); ?>?',
                text: '<?php echo e(\App\CPU\translate('Be careful before you turn on/off maintenance mode')); ?>',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.get({
                        url: '<?php echo e(route('admin.maintenance-mode')); ?>',
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('#loading').show();
                        },
                        success: function (data) {
                            toastr.success(data.message);
                        },
                        complete: function () {
                            $('#loading').hide();
                        },
                    });
                } else {
                    location.reload();
                }
            })
        };

        function currency_symbol_position(route) {
            $.get({
                url: route,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    toastr.success(data.message);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#phone_verification_on").click(function () {
                <?php if(env('APP_MODE')!='demo'): ?>
                if ($('#email_verification_on').prop("checked") == true) {
                    $('#email_verification_off').prop("checked", true);
                    $('#email_verification_on').prop("checked", false);
                    const message = "<?php echo e(\App\CPU\translate('Both Phone & Email verification can not be active at a time')); ?>";
                    toastr.info(message);
                }
                <?php else: ?>
                call_demo();
                <?php endif; ?>
            });
            $("#email_verification_on").click(function () {
                if ($('#phone_verification_on').prop("checked") == true) {
                    $('#phone_verification_off').prop("checked", true);
                    $('#phone_verification_on').prop("checked", false);
                    const message = "<?php echo e(\App\CPU\translate('Both Phone & Email verification can not be active at a time')); ?>";
                    toastr.info(message);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/business-settings/website-info.blade.php ENDPATH**/ ?>