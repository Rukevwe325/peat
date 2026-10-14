<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
  <tr>
    <td align="center">
      <!-- Main Container -->
      <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; overflow: hidden; border: 1px solid #e0e0e0;">
        <!-- Header -->
        <tr>
          <td style="background-color: #4f46e5; color: #ffffff; text-align: center; padding: 30px;">
            <h1 style="margin: 0; font-size: 28px;">Your Car Service Booking 🚗</h1>
            <p style="margin: 5px 0 0; font-size: 16px;">Here’s the info you submitted:</p>
          </td>
        </tr>

        <!-- Booking Details -->
        <tr>
          <td style="padding: 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #4f46e5; width: 150px;">Name:</td>
                <td style="padding: 10px; color: #333333;">{{ $booking->name }}</td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #4f46e5;">Email:</td>
                <td style="padding: 10px; color: #333333;">{{ $booking->email }}</td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #4f46e5;">Service:</td>
                <td style="padding: 10px; color: #333333;">{{ $booking->service }}</td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #4f46e5;">Service Date:</td>
                <td style="padding: 10px; color: #333333;">{{ $booking->service_date }}</td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #4f46e5;">Car Model:</td>
                <td style="padding: 10px; color: #333333;">{{ $booking->car_model }}</td>
              </tr>
              @if($booking->special_request)
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #4f46e5;">Special Request:</td>
                <td style="padding: 10px; color: #333333;">{{ $booking->special_request }}</td>
              </tr>
              @endif
            </table>

            <p style="text-align: center; margin: 30px 0 0; font-size: 16px; color: #555555;">
              Thank you for choosing <strong style="color: #4f46e5;">Our Car Service</strong>!<br>
              We’ll make sure your car gets the care it deserves.
            </p>

            <!-- Optional CTA Button -->
            <p style="text-align: center; margin: 20px 0;">
              <a href="#" style="background-color: #4f46e5; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 5px; display: inline-block; font-weight: bold;">View Booking Details</a>
            </p>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style="background-color: #f9f9f9; text-align: center; padding: 20px; font-size: 14px; color: #999999;">
            &copy; {{ date('Y') }} Our Car Service. All rights reserved.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
