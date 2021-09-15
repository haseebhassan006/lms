@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-clockpicker/bootstrap-clockpicker.min.css">
@endpush

@section('content')

    <form action="/panel/meetings/{{ $meeting->id }}/update" method="post">
        {{ csrf_field() }}
        <section>
            <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                <h2 class="section-title">{{ trans('panel.my_timesheet') }}</h2>

                <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="mb-0 mr-10 cursor-pointer font-14 text-gray font-weight-500" for="temporaryDisableMeetingsSwitch">{{ trans('panel.temporary_disable_meetings') }}</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="disabled" class="custom-control-input" id="temporaryDisableMeetingsSwitch" {{ $meeting->disabled ? 'checked' : '' }}>
                        <label class="custom-control-label" for="temporaryDisableMeetingsSwitch"></label>
                    </div>
                </div>
            </div>

            <div class="panel-section-card time-sheet py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <td class="text-left text-gray font-weight-500">{{ trans('public.day') }}</td>
                                    <td class="text-left text-gray font-weight-500">{{ trans('public.availability_times') }}</td>
                                    <td class="text-right text-gray font-weight-500">{{ trans('public.controls') }}</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(\App\Models\MeetingTime::$days as $day)
                                    <tr id="{{ $day }}TimeSheet" data-day="{{ $day }}">
                                        <td class="text-left">
                                            <span class="font-weight-500 text-dark-blue d-block">{{ trans('panel.'.$day) }}</span>
                                            <span class="font-12 text-gray">{{ isset($meetingTimes[$day]) ? $meetingTimes[$day]["hours_available"] : 0 }} {{ trans('home.hours') .' '. trans('public.available') }}</span>
                                        </td>
                                        <td class="time-sheet-items text-left align-middle">
                                            @if(isset($meetingTimes[$day]))
                                                @foreach($meetingTimes[$day]["times"] as $time)
                                                    <div class="position-relative selected-time px-15 py-5 mb-10 mb-lg-0 bg-gray200 rounded d-inline-block mr-10">
                                                        <span class="inner-time text-gray font-12">{{ $time->time }}</span>
                                                        <span data-time-id="{{ $time->id }}" class="remove-time rounded-circle bg-danger">
                                                        <i data-feather="x" width="12" height="12"></i>
                                                    </span>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </td>
                                        <td class="text-right align-middle">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="add-time btn-transparent webinar-actions d-block mt-10">{{ trans('public.add_time') }}</button>

                                                    @if(isset($meetingTimes[$day]) and !empty($meetingTimes[$day]["hours_available"]) and $meetingTimes[$day]["hours_available"] > 0)
                                                        <button type="button" class="clear-all btn-transparent webinar-actions d-block mt-10">{{ trans('public.clear_all') }}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-30">
            <h2 class="section-title">{{ trans('panel.my_hourly_charge') }}</h2>

            <div class="row align-items-center mt-20">

                <div class="col-12 col-md-4">
                    <label class="font-weight-500 font-14 text-dark-blue d-block">{{ trans('panel.amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text text-white font-16">
                            {{ $currency }}
                        </span>
                        </div>
                        <input type="text" name="amount" value="{{ !empty($meeting) ? $meeting->amount : old('amount') }}" class="form-control" placeholder="{{ trans('panel.number_only') }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label class="font-weight-500 font-14 text-dark-blue d-block">{{ trans('panel.discount') }} (%)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text text-white font-16">
                            {{ $currency }}
                        </span>
                        </div>
                        <input type="text" name="discount" value="{{ !empty($meeting) ? $meeting->discount : old('discount') }}" class="form-control" placeholder="{{ trans('panel.number_only') }}"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <button type="button" id="meetingSettingFormSubmit" class="btn btn-sm btn-primary mt-30">{{ trans('public.submit') }}</button>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/bootstrap-clockpicker/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript">

        var saveLang = '{{ trans('public.save') }}';
        var closeLang = '{{ trans('public.close') }}';
        var successDeleteTime = '{{ trans('meeting.success_delete_time') }}';
        var errorDeleteTime = '{{ trans('meeting.error_delete_time') }}';
        var successSavedTime = '{{ trans('meeting.success_save_time') }}';
        var errorSavingTime = '{{ trans('meeting.error_saving_time') }}';
        var noteToTimeMustGreater = '{{ trans('meeting.note_to_time_must_greater_from_time') }}';
        var requestSuccess = '{{ trans('public.request_success') }}';
        var requestFailed = '{{ trans('public.request_failed') }}';
        var saveMeetingSuccessLang = '{{ trans('meeting.save_meeting_setting_success') }}';
        var toTimepicker, fromTimepicker;


        function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

    function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

          function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



  function substringText($element, am_pm) {
    var val = $element.val();
    var time = val.substring(0, val.length - 2);
    $element.val(time + am_pm);
    return time;
  } // toTimepicker and fromTimepicker are defined globally in blade


  function handleToTime() {
    toTimepicker = $('.to-clockpicker').clockpicker({
      placement: 'bottom',
      align: 'left',
      'default': '10:00AM',
      autoclose: true,
      twelvehour: true,
      afterDone: function afterDone() {
        handleFromTome();
        fromTimepicker.clockpicker('show');
        toTimepicker.clockpicker('remove');
        var to_time = $('.to-clockpicker input');
        var am_pm = $('.to-time .js-am-pm').text();
        $('.to-time').removeClass('pulsate').html(substringText(to_time, am_pm) + ' <span class="js-am-pm font-20">' + am_pm + '</span>');
        $('#timeTwelveSwitch').prop('disabled', true);
      }
    });
  }

  handleToTime();

  function handleFromTome() {
    fromTimepicker = $('.from-clockpicker').clockpicker({
      placement: 'bottom',
      align: 'left',
      autoclose: true,
      'default': '09:00AM',
      twelvehour: true,
      afterDone: function afterDone() {
        handleToTime();
        fromTimepicker.clockpicker('remove');
        toTimepicker.clockpicker('show');
        var from_time = $('.from-clockpicker input');
        var am_pm = $('.from-time .js-am-pm').text();
        $('.from-time').removeClass('pulsate').html(substringText(from_time, am_pm) + ' <span class="js-am-pm font-20">' + am_pm + '</span>');
        $('.to-time').addClass('pulsate');
      }
    });
    fromTimepicker.clockpicker('show');
  }

  $('body').on('change', '#timeTwelveSwitch', function (e) {
    e.preventDefault();
    var type = 'AM';
    var replace = 'PM';

    if (this.checked) {
      type = 'PM';
      replace = 'AM';
    }

    var $fromText = $('.from-time.pulsate').find('.js-am-pm');
    var $toText = $('.to-time.pulsate').find('.js-am-pm');

    if ($fromText.length) {
      $fromText.text(type);
      var $from = $('.from-clockpicker input');
      var from_time = $from.val();
      from_time = from_time.replace(replace, type);
      $from.val(from_time);
    }

    if ($toText.length) {
      $toText.text(type);
      var $to = $('.to-clockpicker input');
      var to_time = $to.val();
      to_time = to_time.replace(replace, type);
      $to.val(to_time);
    }
  });
  $('body').on('click', '.add-time', function (e) {
    e.preventDefault();
    var day = $(this).closest('tr').attr('data-day');
    var add_time_html = '<div class="add-time-sheet row flex-column-reverse flex-lg-row align-items-center justify-content-center justify-content-lg-between">\n' + '        <div class="clock-box col-12 col-lg-4 d-block position-relative d-flex align-items-center justify-content-center justify-content-lg-start">\n' + '            <div class="from-clockpicker">\n' + '                <input type="hidden" class="form-control " value="AM">\n' + '            </div>\n' + '            <div class="to-clockpicker">\n' + '                <input type="hidden" class="form-control " value="AM">\n' + '            </div>\n' + '        </div>\n' + '   <div class="col-12 col-lg-8">' + '     <div class="row">' + '        <div class="col-12 col-lg-4 mb-20 mb-lg-0 d-flex align-items-center justify-content-center custom-control custom-switch on-off-switch pl-0 py-0 py-lg-50">\n' + '            <label style="margin-right: 60px">AM</label>\n' + '            <input type="checkbox" class="custom-control-input" id="timeTwelveSwitch">\n' + '            <label class="custom-control-label" for="timeTwelveSwitch">PM</label>\n' + '        </div>\n' + '\n' + '        <div class="col-12 col-lg-8 d-flex flex-column align-items-center justify-content-center py-0 py-lg-50">\n' + '            <div class="font-48 text-primary from-time pulsate">03:00 <span class="js-am-pm font-16">AM</span></div>\n' + '            <div class="font-weight-500 text-dark-blue">To</div>\n' + '            <div class="font-48 text-primary to-time">04:00 <span class="js-am-pm font-16">AM</span></div>\n' + '        </div>\n' + '    </div>' + '   </div>' + '  </div>' + '<div class="mt-30 d-flex align-items-center justify-content-end">\n' + '    <button type="button" data-day="' + day + '" id="saveTime" class="btn btn-sm btn-primary">' + saveLang + '</button>\n' + '    <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">' + closeLang + '</button>\n' + '</div>';
    Swal.fire({
      html: add_time_html,
      showCancelButton: false,
      showConfirmButton: false,
      customClass: {
        content: 'p-0 text-left'
      },
      width: '48rem',
      onOpen: function onOpen() {
        setTimeout(function () {
          handleFromTome();
        }, 300);
      },
      onClose: function onClose() {
        fromTimepicker.clockpicker('remove');
        toTimepicker.clockpicker('remove');
      }
    });
  });
  $('body').on('click', '#saveTime', function (e) {
    e.preventDefault();
    var $this = $(this);
    var from_time = $('.from-clockpicker input').val();
    var to_time = $('.to-clockpicker input').val();
    var day = $this.attr('data-day');
    $this.addClass('loadingbar primary').prop('disabled', true);
    var data = {
      day: day,
      time: from_time + '-' + to_time
    };
    $.post('/panel/meetings/saveTime', data, function (result) {
      if (result && result.code == 200) {
        Swal.fire({
          title: "Success",
          text: successSavedTime,
          showConfirmButton: false,
          icon: 'success'
        });
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      }
    }).fail(function () {
      Swal.fire({
        title: errorSavingTime,
        text: noteToTimeMustGreater,
        icon: 'error'
      });
      $this.removeClass('loadingbar primary').prop('disabled', false);
    }).always(function () {
      fromTimepicker.clockpicker('remove');
      toTimepicker.clockpicker('remove');
    });
  });

  function deleteTimeModal(time_id) {
    var html = '<div class="">\n' + '    <p class="">Delete Successfully</p>\n' + '    <div class="mt-30 d-flex align-items-center justify-content-center">\n' + '        <button type="button" id="deleteTime" data-time-id="' + time_id + '" class="btn btn-sm btn-primary">Are Your Sure To Delete</button>\n' + '        <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Cancel</button>\n' + '    </div>\n' + '</div>';
    Swal.fire({
      title: "Deleted",
      html: html,
      icon: 'warning',
      showConfirmButton: false,
      showCancelButton: false,
      allowOutsideClick: function allowOutsideClick() {
        return !Swal.isLoading();
      }
    });
  }

  $('body').on('click', '.remove-time', function (e) {
    e.preventDefault();
    var $this = $(this);
    var time_id = $this.attr('data-time-id');
    deleteTimeModal(time_id);
  });
  $('body').on('click', '#deleteTime', function (e) {
    e.preventDefault();
    var $this = $(this);
    var time_id = $this.attr('data-time-id');
    time_id = time_id.split(',');
    handleRemoveTime(time_id);
    Swal.close();

    var _iterator = _createForOfIteratorHelper(time_id),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var id = _step.value;
        $('.remove-time[data-time-id="' + id + '"]').parent().remove();
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  });

  function handleRemoveTime(time_id) {
    var data = {
      time_id: time_id
    };
    $.post('/panel/meetings/deleteTime', data, function (result) {
      $.toast({
        heading: "Deleted",
        text: successDeleteTime,
        bgColor: '#43d477',
        textColor: 'white',
        hideAfter: 5000,
        position: 'bottom-right',
        icon: 'success'
      });
    }).fail(function () {
      $.toast({
        heading: deleteAlertFail,
        text: errorDeleteTime,
        bgColor: '#f63c3c',
        textColor: 'white',
        hideAfter: 5000,
        position: 'bottom-right',
        icon: 'error'
      });
    });
  }

  $('body').on('click', '.clear-all', function (e) {
    e.preventDefault();
    var parent = $(this).closest('tr');
    var timeIds = parent.find('.selected-time .remove-time').map(function () {
      return this.dataset.timeId;
    }).get();
    deleteTimeModal(timeIds.join(','));
  });
  $('body').on('change', '#temporaryDisableMeetingsSwitch', function (e) {
    e.preventDefault();
    var $this = $(this);
    loadingSwl();
    var disable = false;

    if (this.checked) {
      disable = true;
    }

    var data = {
      disable: disable
    };
    $.post('/panel/meetings/temporaryDisableMeetings', data, function (result) {
      if (result && result.code == 200) {
        Swal.fire({
          text: requestSuccess,
          showConfirmButton: false,
          icon: 'success'
        });
        setTimeout(function () {
          Swal.close();
        }, 2000);
      }
    }).fail(function () {
      Swal.fire({
        text: requestFailed,
        icon: 'error'
      });
      $this.removeClass('loadingbar primary').prop('disabled', false);
    });
  });
  $('body').on('click', '#meetingSettingFormSubmit', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $form = $this.closest('form');
    var action = $form.attr('action');
    var data = serializeObjectByTag($form);
    $this.addClass('loadingbar primary').prop('disabled', true);
    $.post(action, data, function (result) {
      if (result && result.code === 200) {
        Swal.fire({
          icon: 'success',
          html: '<h3 class="font-20 text-center text-dark-blue py-25">' + saveMeetingSuccessLang + '</h3>',
          showConfirmButton: false,
          width: '25rem'
        });
        setTimeout(function () {
          window.location.reload();
        }, 500);
      }
    }).fail(function (err) {
      $this.removeClass('loadingbar primary').prop('disabled', false);
      var errors = err.responseJSON;

      if (errors && errors.errors) {
        Object.keys(errors.errors).forEach(function (key) {
          var error = errors.errors[key];
          var element = $form.find('[name="' + key + '"]');
          element.addClass('is-invalid');
          element.parent().find('.invalid-feedback').text(error[0]);
        });
      }
    });
  });


    </script>
@endpush
