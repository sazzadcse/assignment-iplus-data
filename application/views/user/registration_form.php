<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center p-4">User Registration</h2>
        </div>
    </div>

    <form method="POST" id="iplus_user_registration_form" class="" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="applicant_name" class="col-sm-2 col-form-label">Applicant's Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="applicant_name" name="applicant_name"
                    placeholder="Enter your name">
            </div>
        </div>

        <div class="form-group row">
            <label for="applicant_email" class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="applicant_email" name="applicant_email"
                    placeholder="test@test.com">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Mailing Address</label>
            <div class="col-sm-10">
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="applicant_division">Division</label>
                        <select id="applicant_division" name="applicant_division" class="form-control">
                            <option value="">Select Division..</option>
                            <?php 
                                if( !empty( $divisions ) ){
                                    foreach( $divisions as $divsion ){ ?>
                                        <option value="<?php echo $divsion->id;?>"> <?php echo $divsion->division_en; ?> </option>
                                <?php }
                                }
                            ?>
                            
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="applicant_district">District</label>
                        <select id="applicant_district" name="applicant_district" class="form-control">
                            <option value="">Select District..</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="applicant_upazila">Upazila/Thana</label>
                        <select id="applicant_upazila" name="applicant_upazila" class="form-control">
                            <option value="">Select Upazila/Thana..</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Address Details</label>
            <div class="col-sm-10">
                <textarea id="address_details" name="address_details" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Language Proficiency</legend>
                <div class="col-sm-10">

                    <div class="form-check">
                        <input class="form-check-input col-sm-1" type="checkbox" name="language_proficiency_bangla" value="bangla"
                            id="bangla">
                        <label class="form-check-label" for="bangla">
                            Bangla
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input col-sm-1" type="checkbox" name="language_proficiency_english"
                            value="english" id="english">
                        <label class="form-check-label" for="english">
                            English
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input col-sm-1" type="checkbox" name="language_proficiency_french"
                            value="french" id="french">
                        <label class="form-check-label" for="french">
                            French
                        </label>
                    </div>

                </div>
            </div>
        </fieldset>




        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Education Qualification</label>
            <div class="col-sm-10 educational-qualifacation-area">

                <div class="row edu-qul-inner">

                    <div class="form-group col-md-3">
                        <label for="applicant_exam_name_0">Exam Name</label>
                        <select id="applicant_exam_name_0" name="applicant_exam_name[]" class="form-control applicant-exam-name">
                            <option value="">Select Exam..</option>
                            <?php 
                                if( !empty( $examinations ) ){
                                    foreach( $examinations as $exm ) { ?>
                                        <option value="<?php echo $exm->id; ?>"> <?php echo $exm->name; ?> </option>
                                   <?php }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="applicant_university_0">University</label>
                        <select id="applicant_university_0" name="applicant_university[]" class="form-control applicant-university">
                            <option value="">Select University..</option>
                            <?php 
                                if( !empty( $universities ) ){
                                    foreach( $universities as $university ) { ?>
                                        <option value="<?php echo $university->id; ?>"> <?php echo $university->name; ?> </option>
                                   <?php }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="applicant_board_0">Board</label>
                        <select id="applicant_board_0" name="applicant_board[]" class="form-control applicant-board">
                            <option value="">Select Board..</option>
                            <?php 
                                if( !empty( $boards ) ){
                                    foreach( $boards as $board ) { ?>
                                        <option value="<?php echo $board->id; ?>"> <?php echo $board->name; ?> </option>
                                   <?php }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="applicant_result_0">Result</label>
                        <input type="text" class="form-control applicant-result" id="applicant_result_0" name="applicant_result[]"
                            placeholder="0.0">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Action</label>
                        <div class="action-area">
                            <span class="text-success add-more-education">Add more</span>
                        </div>
                    </div>

                </div>
                <!--/.educational-qualifacation -->

            </div>
        </div>

        <div class="form-group row">
            <label for="applicant_photo" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
                <div class="custom-file mb-3">
                    <input type="file" class="form-control applicantPhoto" id="applicant_photo" name="applicant_photo">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="applicant_photo" class="col-sm-2 col-form-label">CV Attachment</label>
            <div class="col-sm-10">
                <div class="custom-file mb-3">
                    <input type="file" class="form-control" id="applicant_cv" name="applicant_cv">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Training</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input col-sm-1 toggole-training" type="radio" name="training" value="yes" id="training_yes">
                    <label class="form-check-label" for="training_yes">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input col-sm-1 toggole-training" type="radio" name="training" value="no" id="training_no" checked>
                    <label class="form-check-label" for="training_no">
                        No
                    </label>
                </div>


                <div class="training-details p-2" style="display:none;">
                    <div class="row training-details-inner">
                        <div class="form-group col-md-4">
                            <label for="training_name_0">Training Name</label>
                            <input type="text" class="form-control" id="training_name_0" name="training_name[]">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="training_details_0">Training Details</label>
                            <input type="text" class="form-control" id="training_details_0" name="training_details[]">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Action</label>
                            <div class="action-area">
                                <span id="add_more_training_0" class="text-success add-more-training">Add more</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>



        </div>



        <div class="form-group row">
            <div class="col-sm-12 text-right">
                <button id="submit_btn" type="submit" class="btn btn-primary btn-submit">Submit</button>
            </div>
        </div>



    </form>



</div>