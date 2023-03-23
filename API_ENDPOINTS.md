### bank-customer/v1/profile 
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &CustomerSearchResultDto
  }
}
```
##### Functionality

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
      "id": "xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &CustomerDto
  }
}
```

##### Functionality

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &CustomerDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &CustomerDto
  }
}
```

##### Functionality

#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &CustomerDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &CustomerDto
  }
}
```

##### Functionality

### bank-customer/v1/beneficiary
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &BeneficiarySearchResultDto
  }
}
```
##### Functionality

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
      "id": "xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &BeneficiaryDto
  }
}
```
##### Functionality

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BeneficiaryDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BeneficiaryDto
  }
}
```

##### Functionality

#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BeneficiaryDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BeneficiaryDto
  }
}
```

##### Functionality

### master-data/v1/lc-clause
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &LcClauseSearchResultDto
  }
}
```
##### Functionality

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &LcClauseDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &LcClauseDto
  }
}
```
##### Functionality
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &LcClauseDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &LcClauseDto
  }
}
```
##### Functionality
#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &LcClauseDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &LcClauseDto
  }
}
```
##### Functionality




#### GET ALL METADATA BY CATEGORY
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "categoryName": "xyz",
    "dataGroup": "xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcClauseCategorySearchResultDto
  }
}
```
##### Functionality

### master-data/v1/bank
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &BankSearchResultDto
  }
}
```
##### Functionality
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankDto
  }
}
```

##### Functionality
#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankDto
  }
}
```

##### Functionality
### master-data/v1/bank-branch
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &BankBranchSearchResultDto
  }
}
```
##### Functionality

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankBranchDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankBranchDto
  }
}
```
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankBranchDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankBranchDto
  }
}
```
##### Functionality
#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankBranchDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &BankBranchDto
  }
}
```
##### Functionality

### bank-doc-manager/v1/file/upload
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     "fileName": "xyz.txt",
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     filePath = '../../xyz.txt'
  }
}
```
##### Functionality


### issuer/v1/lc-application
#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
  }
}
```

##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcSearchResultDto
}
```

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "id":"xyz"
  }
}
```

##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcApplicationDto
}
```
##### Functionality
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &lcApplicationDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcApplicationDto
  }
}
```
##### Functionality
#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &lcApplicationDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     &lcApplicationDto
  }
}
```
##### Functionality

### bank-doc-manager/v1/file/upload
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
     "fileName": "xyz.txt",
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
     filePath = '../../xyz.txt'
  }
}
```
##### Functionality

### message-manager/v1/inbox
#### GET BY GetMessageThreadByLcId
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
      "GetMessageThreadByLcId": "xyz",
      "messageInitiatedBy": "LOGIN003"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &messageInboxDto
  }
}
```
##### Functionality

### message-manager/v1/send
#### Post 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &saveMessageDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &saveMessageDto
  }
}
```
##### Functionality
### bank-customer/v1/branch
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &customerBranchSearchResultDto
  }
}
```
##### Functionality
### Post  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &customerBranchDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &customerBranchDto
  }
}
```
##### Functionality
### issuer/v1/amendment
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcAmendmentSearchResultDto
  }
}
```
#### Get BY ID 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "id":"xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcAmendmentDto
  }
}
```
##### Functionality
#### POST 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcAmendmentDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcAmendmentDto
  }
}
```
##### Functionality
#### PUT 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcAmendmentDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcAmendmentDto
  }
}
```
##### Functionality

### issuer/v1/amendment/forward
#### POST  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcAmendmentForwardDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcAmendmentForwardSearchResultDto
  }
}
```
##### Functionality

### master-data/v1/district
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcDistrictSearchResultDto
  }
}
```

### master-data/v1/police-station
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcPoliceStationSearchResultDto
  }
}
```
##### Functionality

### master-data/v1/lc-type
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcTypeSearchResultDto
  }
}
```
##### Functionality
### master-data/v1/lc-clause/category
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcClauseCategorySearchResultDto
  }
}
```
##### Functionality

### issuer/v1/lc-application/forward
#### Get  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcApplicationForwardSearchResultDto
  }
}
```

##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcApplicationForwardSearchResultDto
  }
}
```

### issuer/v1/lc-application/approval-status
#### PUT  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcApplicantApprovalStatusDto
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcApplicantApprovalStatusDto
  }
}
```

### issuer/v1/lc-application/status
#### PUT  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcStatusDto
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcStatusDto
  }
}
```

### issuer/v1/lc-bank-info
#### GET ALL Issuing Bank   
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "loginUserRole":"xyz"
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &BankSearchResultDto
  }
}
```

#### GET ALL DOCUMENT  
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "loginUserRole":"xyz"
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &allDocumentsDto
  }
}
```

##### Functionality

#### GET ALL ISSUING BANK 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "loginUserRole":"xyz"
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &allIssuingBankDto
  }
}
```

##### Functionality

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &bankDto
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &bankDto
  }
}
```

##### Functionality

#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &bankDto
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &bankDto
  }
}
```

##### Functionality

### issuer/v1/lc-bank-info/forward

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcForwardDto
    }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcForwardDto
  }
}
```

### adviser/v1/lc

#### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &receivedLcSearchResultDto
  }
}
```

#### GET ALL Forward Lc
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &allForwardLcDto
  }
}
```

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "id":"xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &receivedLcDto
  }
}
```

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &receivedLctDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &receivedLctDto
  }
}
```
### issuer/v1/amendment/count

#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "id":"xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &AmendmentCountDto
  }
}
```

### adviser/v1/lc/pre-advice

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &preAdviceLcDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &preAdviceLcDto
  }
}
```

### adviser/v1/lc/forwarding-letter
### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &forwardingLetterDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &forwardingLetterDto
  }
}
```

### adviser/v1/lc/status
#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcStatusDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcStatusDto
  }
}
```

### bill-manager/v1/bill
### GET
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcBillSearchResultDto
  }
}
```

### bill-manager/v1/bill
#### GET BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "id" :"xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcBillSearchResultDto
  }
}
```

#### GET BILL ATTACHED DOCUMENT BY ID
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    "id" :"xyz"
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcBillAttachDocumentDto
  }
}
```

#### POST
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcBillDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcBillDto
  }
}
```
##### FUNCTIONALITY

#### PUT
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcBillDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcBillDto
  }
}
```


### bill-manager/v1/bill/status
#### PUT 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &lcBillStatusDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &lcBillForwardDto
  }
}
```

### bill-validator/v1/bill
#### GET BY ID 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &validateLcBillDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &validateLcBillDto
  }
}
```

### doc-template/v1/commercial-invoice
#### PUT 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &commercialInvoiceDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &commercialInvoiceDto
  }
}
```
### master-data/v1/terms-and-condition
#### GET ALL 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {}
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &masterDataTermsAndConditionSearchResultDto
  }
}
```

### master-data/v1/lc-clause/required-document
#### POST 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &materDataRequiredDocumentDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &materDataRequiredDocumentDto
  }
}
```


### master-data/v1/lc-clause/additional-condition
#### POST 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &materDataAdditionalConditionDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &materDataAdditionalConditionDto
  }
}
```

### bill-manager/v1/bill/forward
#### POST 
##### Input 
```json
{
  "header": {...},
  "meta": {},
  "body": {
    &forwardBillDto
  }
}
```
##### Output
```json
{
  "header": {...},
  "meta": {},
  "body": {
      &forwardBillDto
  }
}
```