# Documentação


## Modelo Er


[Database](https://github.com/flaviozantut/current-account/raw/master/docs/database.png)


### [Insomnia](https://insomnia.rest/download) workspace

[Download](Insomnia.json)





### Criando um usuário 

    curl --request POST \
    --url https://floating-everglades-20235.herokuapp.com/user \
    --header 'content-type: application/json' \
    --data '{
            "full_name": "User 1",
            "email":  "email1@user.com",
            "document_id": "27078814061",
            "type": "commom"
        }'



### Transações

    curl --request POST \
    --url https://floating-everglades-20235.herokuapp.com/transaction \
    --header 'content-type: application/json' \
    --data '{
        "value" : 1,
        "payer" : 1,
        "payee" :11
    }'



### Adicinar creditos

    curl --request POST \
    --url https://floating-everglades-20235.herokuapp.com/user/id/2/credit \
    --header 'content-type: application/json' \
    --data '{
        "value": 100
    }'



### Listar usuários

    curl --request GET \
    --url https://floating-everglades-20235.herokuapp.com/user \
    --header 'content-type: application/json'