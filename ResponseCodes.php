<?php

namespace MElaraby\Payfort;

enum ResponseCodes: string
{
    case InvalidRequest = '00';
    case OrderStored = '01';
    case AuthorizationSuccess = '02';
    case AuthorizationFailed = '03';
    case CaptureSuccess = '04';
    case CaptureFailed = '05';
    case RefundSuccess = '06';
    case RefundFailed = '07';
    case AuthorizationVoidedSuccessfully = '08';
    case AuthorizationVoidFailed = '09';
    case Incomplete = '10';
    case CheckStatusFailed = '11';
    case CheckStatusSuccess = '12';
    case PurchaseFailure = '13';
    case PurchaseSuccess = '14';
    case UncertainTransaction = '15';
    case TokenizationFailed = '17';
    case TokenizationSuccess = '18';
    case TransactionPending = '19';
    case OnHold = '20';
    case SDKTokenCreationFailure = '21';
    case SDKTokenCreationSuccess = '22';
    case FailedToProcessDigitalWalletService = '23';
    case DigitalWalletOrderProcessedSuccessfully = '24';
    case CheckCardBalanceFailed = '27';
    case CheckCardBalanceSuccess = '28';
    case RedemptionFailed = '29';
    case RedemptionSuccess = '30';
    case ReverseRedemptionTransactionFailed = '31';
    case ReverseRedemptionTransactionSuccess = '32';
    case TransactionInReview = '40';
    case CurrencyConversionSuccess = '42';
    case CurrencyConversionFailed = '43';
    case ThreeDSSuccess = '44';
    case ThreeDSFailed = '45';
    case BillCreationSuccess = '46';
    case BillCreationFailed = '47';
    case GeneratingInvoicePaymentLinkSuccess = '48';
    case GeneratingInvoicePaymentLinkFailed = '49';
    case BatchFileUploadSuccessfully = '50';
    case UploadBatchFileFailed = '51';
    case TokenCreatedSuccessfully = '52';
    case TokenCreationFailed = '53';
    case GetTokensSuccess = '54';
    case GetTokensFailed = '55';
    case ReportingRequestCodeSuccess = '56';
    case ReportingRequestFailed = '57';
    case TokenUpdatedSuccessfully = '58';
    case TokenUpdatedFailed = '59';
    case GetInstallmentPlansSuccessfully = '62';
    case GetInstallmentPlansFailed = '63';
    case DeleteTokenSuccess = '66';
    case GetBatchResultsSuccessfully = '70';
    case GetBatchResultsFailed = '71';
    case BatchProcessingSuccess = '72';
    case BatchProcessingFailed = '73';
    case BankTransferSuccessfully = '74';
    case BankTransferFailed = '75';
    case BatchValidationSuccessfully = '76';
    case BatchValidationFailed = '77';
    case CreditCardVerifiedSuccessfully = '80';
    case FailedToVerifyCreditCard = '81';

}
