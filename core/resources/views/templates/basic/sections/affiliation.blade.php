@php
$affiliate = getContent('affiliation.content',true);


$refferals = App\Models\Refferal::get(['level','percent']);

@endphp
<!--=======Service-Section Starts Here=======-->
<div id="app">
    <div class="pb-80 pt-150">
        <div class="col-lg-12 text-center">
            <div class="banner-content">
                <h2 class="title">Affiliation</h2>
                <div class="breadcrumb-area">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://money-exchange-sefina.com">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Affiliation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="affiliate-section ptb-80">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-8">
                    <div class="section-header text-center">
                        <span>affiliate programe</span>
                        <h2>sefina Affiliates</h2>
                        <p>sefina- Secure and Suitable Currency Exchange Platform</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
            </div>
        </div>
    </section>
</div>
@push('style')
    <style>
        .nowrap{
            white-space: nowrap;
        }
        .exchange-nav .black-logo{
            display:block;
        }
        .dropdown button{
            color: #000;
        }
        .exchange-nav .white-logo{
            display:none;
        }
    </style>
@endpush
<!--=======Service-Section Ends Here=======-->

