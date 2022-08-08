'use strict';
var $ = jQuery;

var $iplusMain = {

    divisionEl  : "#applicant_division",
    districtEl  : "#applicant_district",
    addMoreEd   : ".add-more-education",
    removeEdu   : ".remove-education",
    addMoreTr   : ".add-more-training",

    init_iplusMain: function($){

        jQuery(document).ready(function($) {
            $iplusMain.init_district_options();
            $iplusMain.init_upazila_options();
            $iplusMain.append_more_education();
            $iplusMain.append_more_training();
            $iplusMain.toggole_training();

        });

    },

    // load districts by division
    init_district_options : function () {

        if ( $iplusMain.divisionEl ) {

            $( $iplusMain.divisionEl ).on( 'change', function(){

                $('#applicant_upazila').html('<option>Select Upazila/Thana..</option>');

                var $division_id = $( $iplusMain.divisionEl ).val();

                if( !$division_id ){
                    return;
                }

                let $post_data = {
                    'division_id': $division_id
                };

                //call to
                $.ajax({
                    url: $baseUrl + "ajax/get_districts",
                    type: "POST",
                    data: $post_data,
                    success: function (response) {
                        var $data = JSON.parse(response);

                        if ( $data.status == true && $data.options !== '' ) {
                            $("#applicant_district").html($data.options);
                        } else {
                            console.log('Opps: something is wrong!');
                        }
    
                    }
    
                });

            } );
            
        }

    },
    
    // load districts by division
    init_upazila_options : function () {

        if ( $iplusMain.districtEl ) {

            $( $iplusMain.districtEl ).on( 'change', function(){

                var $district_id = $( $iplusMain.districtEl ).val();
                
                if( !$district_id ){
                    return;
                }

                let $post_data = {
                    'district_id': $district_id,
                };

                //call to
                $.ajax({
                    url: $baseUrl + "ajax/get_upazilas",
                    type: "POST",
                    data: $post_data,
                    success: function (response) {
                        var $data = JSON.parse(response);

                        if ( $data.status == true && $data.options !== '' ) {
                            $("#applicant_upazila").html($data.options);
                        } else {
                            console.log('Opps: something is wrong!');
                        }
    
                    }
    
                });

            } );
            
        }

    },

    //define add more education
    append_more_education : function(){
        if( $iplusMain.addMoreEd ){
            $($iplusMain.addMoreEd).on('click', function(){

                let $rows = document.querySelectorAll('.edu-qul-inner');
                let $totalRow = $rows.length;
                
                let $education_new_row = '<div class="row edu-qul-inner">';
                //examination
                $education_new_row += '<div class="form-group col-md-3">';
                $education_new_row += '<label for="applicant_exam_name_'+ $totalRow +'">Exam Name</label>';
                $education_new_row += '<select id="applicant_exam_name_'+ $totalRow +'" name="applicant_exam_name[]" class="form-control applicant-exam-name">';
                $education_new_row += $iplusMain.education_exam_options();
                $education_new_row += '</select>';
                $education_new_row += '</div>';

                //university
                $education_new_row += '<div class="form-group col-md-3">';
                $education_new_row += '<label for="applicant_university_'+ $totalRow +'">University</label>';
                $education_new_row += '<select id="applicant_university_'+ $totalRow +'" name="applicant_university[]" class="form-control applicant-university">';
                $education_new_row += $iplusMain.education_university_options();
                $education_new_row += '</select>';
                $education_new_row += '</div>';

                //boards
                $education_new_row += '<div class="form-group col-md-3">';
                $education_new_row += '<label for="applicant_board_'+ $totalRow +'">Board</label>';
                $education_new_row += '<select id="applicant_board_'+ $totalRow +'" name="applicant_board[]" class="form-control applicant-board">';
                $education_new_row += $iplusMain.education_boards_options();
                $education_new_row += '</select>';
                $education_new_row += '</div>';

                //result
                $education_new_row += '<div class="form-group col-md-1">';
                $education_new_row += '<label for="applicant_result_'+ $totalRow +'">Result</label>';
                $education_new_row += '<input id="applicant_result_'+ $totalRow +'" type="text" class="form-control" name="applicant_result[]" placeholder="0.0">';
                $education_new_row += '</div>';

                //action
                $education_new_row += '<div class="form-group col-md-2">';
                $education_new_row += '<label></label>';
                $education_new_row += '<div class="action-area"><span id="remove_education_'+ $totalRow +'" class="text-danger remove-education" onclick="remove_education_row(this)">Delete</span></div>';
                $education_new_row += '</div>';

                $education_new_row += '</div>';

                $('.educational-qualifacation-area').append($education_new_row);

            });
        }
    },
    
    //define add more education
    append_more_training : function(){
        if( $iplusMain.addMoreTr ){
            $($iplusMain.addMoreTr).on('click', function(){

                let $rows = document.querySelectorAll('.training-details-inner');
                let $totalRow = $rows.length;
                
                let $training_new_row = '<div class="row training-details-inner">';
                //Training Name
                $training_new_row += '<div class="form-group col-md-4">';
                $training_new_row += '<label for="training_name_'+ $totalRow +'">Training Name</label>';
                $training_new_row += '<input type="text" class="form-control" id="training_name_'+ $totalRow +'" name="training_name[]">';
                $training_new_row += '</div>';

                //Training Details
                $training_new_row += '<div class="form-group col-md-4">';
                $training_new_row += '<label for="training_details_'+ $totalRow +'">Training Details</label>';
                $training_new_row += '<input type="text" class="form-control" id="training_details_'+ $totalRow +'" name="training_details[]">';
                $training_new_row += '</div>';

                //action
                $training_new_row += '<div class="form-group col-md-4">';
                $training_new_row += '<label></label>';
                $training_new_row += '<div class="action-area"><span id="remove_training_'+ $totalRow +'" class="text-danger remove-training" onclick="remove_training_row(this)">Delete</span></div>';
                $training_new_row += '</div>';

                $training_new_row += '</div>';
                
                $('.training-details').append($training_new_row);

            });
        }
    },

    //define education examination
    education_exam_options : function(){
        let $options = '<option value="">Select Exam..</option>';
        if( $examinations ){
            $examinations.forEach(function($item){
                $options += '<option value="'+ $item.id +'">'+ $item.name +'</option>';
            });
        }
        return $options;
    },
    
    //define education university options
    education_university_options : function(){
        let $options = '<option value="">Select University..</option>';
        if( $universities ){
            $universities.forEach(function($item){
                $options += '<option value="'+ $item.id +'">'+ $item.name +'</option>';
            });
        }
        return $options;
    },
    
    //define education boards options
    education_boards_options : function(){
        let $options = '<option value="">Select Board..</option>';
        if( $boards ){
            $boards.forEach(function($item){
                $options += '<option value="'+ $item.id +'">'+ $item.name +'</option>';
            });
        }
        return $options;
    },

    //define toggole training
    toggole_training : function() {
        
        var $el = $('.toggole-training');

        $($el).on('change', function(){
            let $this = $(this);
            
            if( $($this).is(':checked') ){
                let $val = $($this).val();
                if( $val == 'yes' ){
                    $('.training-details').fadeIn('slow');
                }else{
                    $('.training-details').fadeOut('slow');
                }
            }

        });

    },

    validate_registration_form : function(){

        // validate signup form on keyup and submit
		$($iplusMain.regForm).validate({
			rules: {
				applicant_name: "required",
				applicant_email: {
                    required:true,
                    email:true
                },
				applicant_division: "required",
				applicant_district: "required",
				applicant_upazila: "required",
				address_details: "required",
				language_proficiency_bangla: "required",
                "applicant_exam_name[]": "required",
				"applicant_university[]": "required",
				"applicant_board[]": "required",
				"applicant_result[]": "required",
                applicant_photo: { 
                    required: true, 
                    extension: "jpg|jpeg" 
                },
                applicant_cv: { 
                    required: true, 
                    extension: "doc|pdf|docx" 
                },
                "training_name[]": { 
                    required: '#training_yes[value="yes"]:checked'
                },
                "training_details[]": { 
                    required: '#training_yes[value="yes"]:checked'
                },
                
			},
            //define validation message here ..
			messages: {
				applicant_name: "Please enter your full name",
				applicant_email: "Please enter a valid email address",
				applicant_division : "This field is required",
				applicant_district: "This field is required",
				applicant_upazila: "This field is required",
				address_details: "This field is required",
				language_proficiency_bangla: "This field is required",
				"applicant_exam_name[]": "This field is required",
				"applicant_university[]": "This field is required",
				"applicant_board[]": "This field is required",
				"applicant_result[]": "This field is required",
                applicant_photo: {
                    required : "Please upload valid image",
                    extension : "Only jpg image allowed"
                },
                applicant_cv: {
                    required : "Please upload valid file",
                    extension : "Only doc or pdf file allowed"
                },
				
			},

            // form submit here..
            submitHandler: function() {

                let $submit_button = $('.btn-submit');
                $submit_button.text( 'Please Wait....' );
                $submit_button.addClass( 'btn-disabled' );
                $submit_button.prop( 'disabled', true );

                $.ajax({
                    url: $baseUrl + "ajax/add_applicant",
                    type: "POST",
                    data: $($iplusMain.regForm).serializeArray(),
                    success: function (response) {
                        var $data = JSON.parse(response);

                        console.log( 'response ', $data );

                        if ($data.status == true) {
                            Command: toastr["success"]($data.message);
        
                            $submit_button.text('Signup');
                            $submit_button.removeClass('btn-disabled');
                            $submit_button.prop('disabled', false);
                            
                        }else{
                            Command: toastr["error"]($data.message);
                            $submit_button.text('Signup');
                            $submit_button.removeClass('btn-disabled');
                            $submit_button.prop('disabled', false);
                            console.log('Oops: something is wrong please try later!');
                            
                        }
                        
                    }
    
                });
                
            }

		});

    },
    

};

// define remove education row
function remove_education_row (view) {
    let $parent = $(view).parent().parent().parent();
    $($parent).fadeOut('slow');
}

// define remove training row
function remove_training_row (view) {
    let $parent = $(view).parent().parent().parent();
    $($parent).fadeOut('slow');
}
    

$iplusMain.init_iplusMain();