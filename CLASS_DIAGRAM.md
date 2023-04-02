```mermaid
classDiagram
    Lc o-- LcContainer
    Lc o-- LcPropertyAtIssuingBank
    Lc o-- LcPropertyAtGlc
    
    LcContainer <|-- SwiftMtLc
    LcContainer <|-- SwiftMxLc
    LcContainer <|-- GreenLc
    LcContainer <|-- ContourLc
````

```mermaid
classDiagram
    Lc  -->  Customer
    Lc --> Beneficiary
    PreAdvise "0..*" -- "1" Lc
    Lc "1" -- "1..*" ReceivedBill
    ReceivedBill "1" --> "1..*" ReceivedBillDocument
    Lc --> LcType
    
    Lc "1" --> "0..*" LcDocument
    LcDocument <|-- InsuranceCoverage
    LcDocument <|-- LcForwardingLetter
    LcDocument <|--  ProformaInvoice

    LcClause "0..*" -- "1" LcType
    LcClauseTemplate "0..*" -- "1" LcClause
    LcLineItem "1..*" <-- "1" Lc
    
    ReceivedBillDocument <|-- CommercialInvoice
    ReceivedBillDocument <|-- DeliveryChallan
    ReceivedBillDocument <|-- BeneficiaryCertificate
    ReceivedBillDocument <|-- ForwardingLetter
    ReceivedBillDocument <|-- CertificateOfOrigin
    ReceivedBillDocument <|-- BillOfExchange
    ReceivedBillDocument <|-- PackingList

    Amendment "0..*" -- "1" Lc
    AmendmentRequest "0..*" -- "1" Lc


````

```mermaid
classDiagram
    direction RL
    
    ReceivedLineItem <-- ReceivedLc
    ReceivedLc --> Customer
    ReceivedLc --> Applicant
    ReceivedLcAdvise -- ReceivedLc
    
    ReceivedLc <-- Bill
    Bill <--  BillDocument

    ReceivedLc --> LcType
    ReceivedLc "1" --> "0..*" ReceivedLcDocument
    ReceivedLcDocument <|-- InsuranceCoverage
    ReceivedLcDocument <|-- LcForwardingLetter
    ReceivedLcDocument <|--  ProformaInvoice

    BillDocument <|-- CommercialInvoice
    BillDocument <|-- DeliveryChallan
    BillDocument <|-- BeneficiaryCertificate
    BillDocument <|-- ForwardingLetter
    BillDocument <|-- CertificateOfOrigin
    BillDocument <|-- BillOfExchange
    BillDocument <|-- PackingList
    BillDocument <|-- BillItem

    ReceivedAmendment "0..*" -- "1" ReceivedLc

```

