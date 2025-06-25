<style>
    #cookieWrapper {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 100;
        margin: 0;
        border-radius: 0;
    }
    .js-cookie-consent {
        background: #4f198d;
    color: #fff;
    padding: 10px;
    line-height: 32px;
    


    }
    .js-cookie-consent-agree{
        background: #fff;
        color:#4f198d;
        line-height: 28px;
        font-weight: 600;
        margin: 10px auto;

    }
</style>

<div id="cookieWrapper" class="bg-dark text-white w-100 py-3 text-center">
    <div class="js-cookie-consent d-inline  cookie-consent">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}
    </span><br>

        <button onclick="$('#cookieWrapper').remove()"
                class="js-cookie-consent-agree text-dark btn btn-light cookie-consent__agree">
            {{ trans('cookieConsent::texts.agree') }}
        </button>
    </div>
</div>