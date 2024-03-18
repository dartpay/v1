$(function() {
    
    'use strict';

    let sendId, sendMinAmount, sendMaxAmount, sendAmount, sendCurrency, sendCurrencyBuyRate;
    let receivedId, receivedAmount, receivedCurrency, receiveCurrencySellRate;

    const EXCHANGE_FORM = $('#exchange-form');

    EXCHANGE_FORM.on('change', '#send', function(e) {

        sendId = parseInt($(this).val());
        sendMinAmount = parseFloat($(this).find(':selected').data('min'));
        sendMaxAmount = parseFloat($(this).find(':selected').data('max'));
        sendCurrency = $(this).find(':selected').data('currency');
        sendCurrencyBuyRate = parseFloat($(this).find(':selected').data('sell'));

        let imageUrl=$(this).find('option:selected').data('image');
        $('.send-image').prop('src',imageUrl);

        $("#currency-limit").removeClass('d-none').text(`Limit: ${sendMinAmount.toFixed(2)} - ${sendMaxAmount.toFixed(2)} ${sendCurrency}`);

        sameCurrencyCheck();
        validation();
        calculationReceivedAmount();
    });

    EXCHANGE_FORM.on('change', '#receive', function(e) {
        receivedId = parseInt($(this).val());
        receiveCurrencySellRate = parseFloat($(this).find(':selected').data('buy'));
        receivedCurrency = $(this).find(':selected').data('currency');

        let minAmount = parseFloat($(this).find(':selected').data('min'));
        let maxAmount = parseFloat($(this).find(':selected').data('max'));
        let reserveAmount = parseFloat($(this).find(':selected').data('reserve'))

        let imageUrl=$(this).find('option:selected').data('image');
        $('.received-image').prop('src',imageUrl);

        $("#currency-limit-received").removeClass('d-none').text(`Limit: ${minAmount.toFixed(2)} - ${maxAmount.toFixed(2)} ${receivedCurrency} | Reserve ${reserveAmount.toFixed(2)} ${receivedCurrency}`);

        if (!sendId) {
            return false;
        }

        sameCurrencyCheck();
        validation();
        calculationReceivedAmount();
    });

    EXCHANGE_FORM.on('input', '#sending_amount', function(e) {

        let error = true;

        
        this.value = this.value.replace(/^\.|[^\d\.]/g, '');
        sendAmount = parseFloat(this.value);

        if (sendId && receivedId && sendId == receivedId) {
            error = true;
            notify('error', `Send & received currency can not be same`)
        }
        validation();
        calculationReceivedAmount();
    });

    EXCHANGE_FORM.on('input', '#receiving_amount', function(e) {

        let error = true;
        

        if (!sendId) {
            this.value = this.value.replace('');
            return false;
        }

        if (sendId && receivedId && sendId == receivedId) {
            error = true;
            notify('error', `Send & received currency can not be same`)
        }

        this.value = this.value.replace(/^\.|[^\d\.]/g, '');
        receivedAmount = parseFloat(this.value);

        validation();
        sameCurrencyCheck();
        calculationSendAmount();
    });


    const validation = () => {
        let error = true;

        if (sendId && receivedId && sendId == receivedId) {
            error = true;
            notify('error', `Send & received currency can not be same`)
        } else {
            error = false;
        }

        if (error) {
            EXCHANGE_FORM.find("button[type=submit]").addClass('disabled')
            EXCHANGE_FORM.find("button[type=submit]").attr('disabled', true)
        } else {
            EXCHANGE_FORM.find("button[type=submit]").removeClass('disabled')
            EXCHANGE_FORM.find("button[type=submit]").attr('disabled', false)
        }
    }

    const sameCurrencyCheck = () => {
        if(sendId){
            $('.receiveData').find(`.list li`).removeClass('d-none');
            $('.receiveData').find(`.list li[data-value="${sendId}"]`).addClass('d-none');
        }
        if(receivedId){
            $('.sendData').find(`.list li`).removeClass('d-none');
            $('.sendData').find(`.list li[data-value="${receivedId}"]`).addClass('d-none');
        }
    }

    const calculationReceivedAmount = () => {

        if (!sendId && !receivedId && !sendCurrencyBuyRate && !receiveCurrencySellRate) {
            return false;
        }
        let amountReceived = (sendCurrencyBuyRate / receiveCurrencySellRate) * sendAmount;
        $("#receiving_amount").val(amountReceived.toFixed(2))
    }

    const calculationSendAmount = () => {

        if (!sendId && !receivedId && !sendCurrencyBuyRate && !receiveCurrencySellRate) {
            return false;
        }
        let amountReceived = (receiveCurrencySellRate / sendCurrencyBuyRate) * receivedAmount;
        $("#sending_amount").val(amountReceived.toFixed(2))
    }

});
