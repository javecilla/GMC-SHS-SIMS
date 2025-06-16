<x-mail::message>

<img src="https://jerome-avecilla.infinityfreeapp.com/assets/images/gmc/banner.png" alt="banner" loading="lazy"/>

<label><small>{{ __('Good day!') }}</small></label><br/>

<p>
	<small>
		{{ __('Dear') }}
		@if($data['gender'] === 'M')
			{{ __('Mr.') }}
		@else
			{{ __('Ms.') }}
		@endif
		<strong>{{ strtoupper($data['last_name']) }}</strong>, {{ $data['first_name'] }} {{ ucfirst(substr($data['middle_name'], 0, 1)) . '.' }} {{ $data['extension_name'] }}
	</small>
</p>

<p>
	<small>
		{{ __('We are pleased to inform you that we have received your online application. If you believe you have received this email in error, please disregard this message.') }}
	</small>
</p>

<p>
  <small>
    {{ __('Please review and verify the following application details:') }}
  </small>
  <br/>
  <ol style="list-style-type: none;">
    <li><strong>{{ __('Registration No.:') }}</strong> {{ $data['enrollment_no'] }}</li>
    <li><strong>{{ __('Registration Date:') }}</strong> {{ $data['enrollment_date'] }}</li>
    <li><strong>{{ __('Strand:') }}</strong> {{ $data['strand'] }}</li>
    <li><strong>{{ __('Year Level:') }}</strong> {{ $data['year_level'] }}</li>
    <li><strong>{{ __('School Year:') }}</strong> {{ $data['school_year'] }}</li>
    <li><strong>{{ __('Semester:') }}</strong> {{ $data['semester'] }}</li>
    <li><strong>{{ __('Campus:') }}</strong> {{ $data['campus'] }}</li>
  </ol>
</p>

<p>
	<small>
		{{ __('If that confirmed, your appointment schedule for the submission of the required documents will be on') }}
    <strong>{{ $data['appointment_schedule'] }}</strong>
    {{ __('in') }}
    <strong>{{ $data['campus_address'] }}</strong>
  </small>
</p>

<p>
	<strong><small>{{ __('Documents to be submitted:') }}</small></strong><br/>
	<ol>
        <li>{{ __('Form 137 or Grade 10 report card and copy of certificate of Grade 10 completion.') }}</li>
        <li>{{ __('Original PSA-issued Birth Certificate.') }}</li>
        <li>{{ __('Certificate of good moral character from previous school.') }} </li>
        <li>{{ __('2 pcs. 2×2 picture.') }}</li>
        <li>{{ __('1 long brown envelope.') }}</li>
        <li>{{ __('A Certified True Copy of Certification / Membership Certification / Barangay-issued Certificate / ID (if applicable) of the following:') }}
            <ul>
                <li>{{ __('Student with Special Needs (SSN) and other types of disabilities.') }}</li>
                <li>{{ __('Graduate of Alternative Learning System (ALS) (Accreditation &, Equivalency Assessment and Certification).') }}</li>
            </ul>
        </li>
    </ol>
</p>

<p>
	<strong><small>{{ __('Grounds for Disqualification of Application:') }}</small></strong><br/>
	<ol>
        <li>{{ __('Misrepresentation of the information entered in any of the submitted forms (including but not limited to the application portal).') }} </li>
        <li>{{ __('Violation of the application instructions.') }}</li>
        <li>{{ __('Non-submission of documents as schedule.') }}</li>
    </ol>
</p>

<p>
	<small>
		<strong>{{ __('REMINDER:') }}</strong><br/>
		{{ __('Successful Applicants must submit the complete required documents on the exact date of their Appointment. A face-to-face Admission Assessment will be administered by the ') }}
    {{ config('app.name') }}
    {{ __(' Admissions and Orientation Services office. Kindly check your Email regularly (inbox and spam/junk folder).') }}
		<br/>
	</small>
</p>

</x-mail::message>
