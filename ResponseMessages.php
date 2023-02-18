<?php

namespace MElaraby\Payfort;

enum ResponseMessages: string
{
    case Success = '000';
    case MissingParameter = '001';
    case InvalidParameterFormat = '002';
    case PaymentOptionIsNotAvailableForThisMerchantsAccount = '003';
    case InvalidCommand = '004';
    case InvalidAmount = '005';
    case TechnicalProblem = '006';
    case DuplicateOrderNumber = '007';
    case SignatureMismatch = '008';
    case InvalidMerchantIdentifier = '009';
    case InvalidAccessCode = '010';
    case OrderNotCodeSaved = '011';
    case CardExpired = '012';
    case InvalidCurrency = '013';
    case InactivePaymentOption = '014';
    case InactiveMerchantAccount = '015';
    case InvalidCardNumber = '016';
    case OperationNotAllowedByTheAcquirer = '017';
    case OperationNotAllowedByProcessOr = '018';
    case InactiveAcquirer = '019';
    case ProcessorIsInactive = '020';
    case PaymentOptionDeactivatedByAcquirer = '021';
    case CurrencyNotAcceptedByAcquirer = '023';
    case CurrencyNotAcceptedByProcessOr = '024';
    case ProcessorIntegrationSettingsAreMissing = '025';
    case AcquirerIntegrationSettingsAreMissing = '026';
    case InvalidExtraParameters = '027';
    case InsufficientFunds = '029';
    case AuthenticationFailed = '030';
    case InvalidIssuer = '031';
    case InvalidParameterLength = '032';
    case ParameterValueNotAllowed = '033';
    case OperationNotAllowed = '034';
    case OrderCreatedSuccessfully = '035';
    case OrderNotFound = '036';
    case MissingReturnURL = '037';
    case TokenServiceInactive = '038';
    case NoActivePaymentOptionFound = '039';
    case InvalidTransactionSource = '040';
    case OperationAmountExceedsTheAuthorizedAmount = '042';
    case InactiveOperation = '043';
    case TokenNameDoesNotExist = '044';
    case ChannelIsNotConfiguredForTheSelectedPaymentOption = '046';
    case OrderAlreadyProcessed = '047';
    case OperationAmountExceedsCapturedAmount = '048';
    case OperationNotValidForThisPaymentOption = '049';
    case MerchantPerTransactionLimitExceeded = '050';
    case TechnicalError = '051';
    case ConsumerIsNotInOLPDatabase = '052';
    case MerchantIsNotFoundInOLPEngineDB = '053';
    case TransactionCannotBeProcessedAtThisMoment = '054';
    case OLPIDAliasIsNotValidPleaseContactYourBank = '055';
    case OLPIDAliasDoesNotExistPleaseEnterAValidOLPIDAlias = '056';
    case TransactionAmountExceedsTheDailyTransactionLimit = '057';
    case TransactionAmountExceedsThePerTransactionLimit = '058';
    case MerchantNameAndSADADMerchantIDDoNotMatch = '059';
    case TheEnteredOLPPasswordIsIncorrectPleaseProvideAValidPassword = '060';
    case TokenHasBeenCreated = '062';
    case TokenHasBeenUpdated = '063';
    case ThreeDSecureCheckRequested = '064';
    case TransactionWaitingForCustomersAction = '065';
    case MerchantReferenceAlreadyExists = '066';
    case DynamicDescriptorNotConfiguredForSelectedPaymentOption = '067';
    case SDKServiceIsInactive = '068';
    case MappingNotFoundForTheGivenErrorCode = '069';
    case Device_idMismatch = '070';
    case FailedToInitiateConnection = '071';
    case TransactionHasBeenCancelledByTheConsumer = '072';
    case InvalidRequestFormat = '073';
    case TransactionFailed = '074';
//    case TransactionFailed = '075';
    case TransactionNotFoundInOLP = '076';
    case ErrorTransactionCodeNotFound = '077';
    case FailedToCheckFraudScreen = '078';
    case TransactionChallengedByFraudRules = '079';
    case InvalidPaymentOption = '080';
    case InactiveFraudService = '082';
    case UnexpectedUserBehaviOr = '083';
    case TransactionAmountIsEitherBiggerThanMaximumOrLessThanMinimumAmountAcceptedForTheSelectedPlan = '084';
    case InstallmentPlanIsNotConfiguredForMerchantAccount = '086';
    case CardBINDoesNotMatchAcceptedIssuerBank = '087';
    case TokenNameWasNotCreatedForThisTransaction = '088';
    case FailedToRetrieveDigitalWalletDetails = '089';
    case TransactionInReview = '090';
    case InvalidIssuerCode = '092';
    case ServiceInactive = '093';
    case InvalidPlanCode = '094';
    case InactiveIssuer = '095';
    case InactivePlan = '096';
    case OperationNotAllowedForService = '097';
    case InvalidOrExpiredCallId = '098';
    case FailedToExecuteService = '099';
    case InvalidExpiryDate = '100';
    case BillNumberNotFound = '101';
    case ApplePayOrderHasBeenExpired = '102';
    case DuplicateSubscriptionID = '103';
    case NoPlansValidForRequest = '104';
    case InvalidBankCode = '105';
    case InactiveBank = '106';
    case InvalidTransfer_date = '107';
    case ContradictingParametersPleaseReferToTheIntegrationGuide = '110';
    case ServiceNotApplicableForPaymentOption = '111';
    case ServiceNotApplicableForPaymentOperation = '112';
    case ServiceNotApplicableForeCommerceIndicator = '113';
    case TokenAlreadyExist = '114';
    case ExpiredInvoicePaymentLink = '115';
    case InactiveNotificationType = '116';
    case InvoicePaymentLinkAlreadyProcessed = '117';
    case OrderBounced = '118';
    case RequestDropped = '119';
    case PaymentLinkTermsAndConditionsNotFound = '120';
    case CardNumberIsNotVerified = '121';
    case InvalidDateInterval = '122';
    case YouHaveExceededTheMaximumNumberOfAttempts = '123';
    case AccountCodeSuccessfullyCreated = '124';
    case InvoiceAlreadyPaid = '125';
    case DuplicateInvoiceID = '126';
    case MerchantReferenceIsNotGeneratedYet = '127';
    case TheGeneratedReportIsStillPendingYouCantDownloadItNow = '128';
    case DownloadedReportQueueIsFullWaitTillItsEmptyAgain = '129';
    case YourSearchResultsHaveExceededTheMaximumNumberOfRecords = '134';
    case TheBatchFileValidationIsFailed = '136';
    case InvalidBatchFileExecutionDate = '137';
    case TheBatchFileStillUnderValidation = '138';
    case TheBatchFileStillUnderProcessing = '140';
    case TheBatchReferenceDoesNotExist = '141';
    case TheBatchFileHeaderIsInvalid = '142';
    case InvalidBatchFile = '144';
    case TheBatchReferenceIsAlreadyExist = '146';
    case TheBatchProcessRequestHasBeenReceived = '147';
    case BatchFileWillBeProcessed = '148';
    case PaymentLinkRequestIDNotFound = '149';
    case PaymentLinkIsAlreadyOpen = '150';
    case ThreeDsIdDoesNotExist = '151';
    case ThreeDsVerificationDoesntMatchTheRequestDetails = '152';
    case YouHaveReachedTheMaximumNumberOfUploadRetries = '154';
    case TheUploadRetriesIsNotConfigured = '155';
    case OperationNotAllowedTheSpecifiedOrderIsNotConfirmedYet = '662';
    case TransactionDeclined = '666';
    case TransactionClosed = '773';
    case TheTransactionHasBeenProcessedButFailedToReceiveConfirmation = '777';
    case SessionTimeout = '778';
    case TransFormationError = '779';
    case TransactionNumberTransFormationError = '780';
    case MessageOrResponseCodeTransFormationError = '781';
    case InstallmentsServiceInactive = '783';
    case TransactionStillProcessingYouCantMakeAnotherTransaction = '784';
    case TransactionBlockedByFraudCheck = '785';
    case FailedToAuthenticateTheUser = '787';
    case InvalidBillNumber = '788';
    case ExpiredBillNumber = '789';
    case InvalidBillTypeCode = '790';

    /**
     * @param string $statusCode
     * @return bool
     */
    public static function isSuccessStatus(string $statusCode): bool
    {
        return $statusCode === self::Success->value;
    }

    public static function isFailureStatus($statusCode)
    {

    }
}
