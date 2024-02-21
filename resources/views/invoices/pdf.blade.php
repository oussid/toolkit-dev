<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/ea7913d8a3.js" crossorigin="anonymous"></script>

    <title>{{ $invoice->project->business->name }}'s Project Invoice</title>
</head>
<body>
    <div class="main-pdf" style="height: 100vh;">
        <div class="invoice-header" style="display: flex; justify-content: center; align-items: center;">
            <h1 class="invoice-title" style="color: #4543E8;">INVOICE</h1>
        </div>
        <div class="invoice-subheader" style="display: flex; justify-content: center; align-items: center; margin-top: 5rem;">
            <div class="invoice-details" style="flex: 1; display: flex; justify-content: center; flex-direction: column; text-align: center; gap: 1rem;">
                <h2>Invoice id : <span style="color: #4543E8">#{{ $invoice->id }}</span></h2>
                <h2>Creation date : <span style="color: #4543E8">{{ Str::substr($invoice->created_at , 0, 10)}}</span></h2>
                <h2>Update date : <span style="color: #4543E8">{{ Str::substr($invoice->updated_at , 0, 10)}}</span></h2>
            </div>
            <div class="logo" style="flex: 1;">
                <h1 style="display: flex; justify-content: center; align-items: center; font-size:40px; font-style: italic;">
                    <img src="{{ asset("assets/setrun_logo_white_nobg.png") }}" style="width: 50px; height: 50px;">
                SETRUN_</h1>
            </div>
        </div>
        <div class="invoice-body" style="min-height: 30vh; margin-top: 5rem; display: flex; justify-content: center;">
            <table style="width: 80%; height: 20vh; border-collapse: collapse;">
                <tr>
                    <th style="border: 2px solid black;  font-size: 25px; background: #5f5deb; text-align: center;">Client OR Business</th>
                    <th style="border: 2px solid black;  font-size: 25px; background: #5f5deb; text-align: center;">Billing Address</th>
                    <th style="border: 2px solid black;  font-size: 25px; background: #5f5deb; text-align: center;">Additional Services</th>
                    <th style="border: 2px solid black;  font-size: 25px; background: #5f5deb; text-align: center;">Invoice total</th>
                </tr>
                <tr>
                    <td style="border: 2px solid black; background: #F9F9F9; font-size: 20px;text-align: center;">{{ $invoice->project->business->name }}</td>
                    <td style="border: 2px solid black; background: #F9F9F9; font-size: 20px;text-align: center;">{{ $invoice->project->business->address }}</td>
                    <td style="border: 2px solid black; background: #F9F9F9; font-size: 20px;padding:0rem 1rem;"><ul>@forelse (json_decode($invoice->services) as $service )
                        <li style="list-style:none;display: flex;align-items:center;gap:1rem"> <i class="fa-solid fa-arrow-right" style="color: #4543E8"></i>
                            <div style="display: flex;justify-content:space-between;width:100%">
                                <span>{{ $service->name }}</span>
                                <span>{{ $service->price=="FREE"?"FREE":"£".$service->price}}</span>

                            </div>
                        </li>
                        <hr>
                        @empty
                        <h3>No Additional services</h3>
                    @endforelse</ul></td>
                    <td style="border: 2px solid black; background: #F9F9F9; font-size: 20px;text-align: center;">£<span style="color: #4543E8">{{ $invoice->total }}</span></td>
                </tr>
            </table>
        </div>
        <div class="invoice-footer" style="display: flex; justify-content: center; align-items: center;">
            <p>
                If there's any issue with the payments or the invoice please contact us through
                <a href="https://setrun.net" style="text-decoration: none; color: #4543E8">https://setrun.net</a>
                or email us via
                <a href="mailto:contact@setrun.online" style="text-decoration: none; color: #4543E8">contact@setrun.online</a>
            </p>
        </div>
    </div>
</body>
</html>
