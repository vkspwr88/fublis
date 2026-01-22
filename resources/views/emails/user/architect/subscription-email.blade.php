@extends('emails.layouts.master')

@section('body')
<h2 class="admin-header">Congratulations on upgrading to the <strong>{{ $plan_name }}</strong></h2>
<p>Hi {{ $receiver_name }},</p>
<p>We're excited to let you know that your Fublis account has officially been upgraded to our <strong>{{ $plan_name }}</strong>! 🚀</p>
<p>We're committed to helping you achieve your goals and make your voice heard, and this upgrade is just the first step. With the power of our new plan, you'll be one step closer to achieving the recognition you deserve.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>Need Help?</strong></p>
<p>If you have any questions or want tips on how to maximize your new plan, we are ready to assist you every step of the way. Don’t hesitate to reach out, we will ensure you get the most out of your Fublis experience!</p>
<p>Thank you for choosing Fublis. We can't wait to see you shine!</p>
<p>— The Fublis team</p>
<p><x-mail::button :url="$pitch_url">Pitch now</x-mail::button></p>
@endsection
