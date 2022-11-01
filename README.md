# Patrimônio

Sistema criado para facilitar a conferência dos bens patrimoniais.

A idéia é realizar a conferência de tempos em tempos e atualizar as informações no sistema corporativo.

Para tanto esse sistema permite marcar os bens que estão corretos e anotar as alterações para posterior transcrição.

A busca pode ser feita pelo número patrimonial ou por sala.

A EESC desenvolveu uma ferramenta a fim de auxiliar na elaboração do inventário patrimonial. A ferramenta permite consultar as informações do bem a partir do número da etiqueta e realizar as seguintes anotações:

- confirmar se os dados estão corretos
- anotar divergência no localUSP e responsável
- anotar o usuário corrente, se relevante e diferente do responsável
- anotar o local na sala, se relevante
- anotar observações adicionais

As anotações são possíveis para os bens sob sua responsabilidade. 

Caso seja cadastrado como responsável local, a pessoa poderá anotar em todos os bens do setor correspondente.

A ferramenta exibe relatório que indica quais bens ainda não foram localizados.


## Instalação e configuração

* Processo normal do Laravel
* Use o --seed para criar os locais pela primeira vez (SET, Lamem e LMCC)

### Locais USP

Os locais USP não são associados a centros de despesa ou setores. O sistema permite associar um local a um setor para autorizar gerentes locais do setor a listar os bens desses locais.

### MariaDB e json

Adicionado suporte à sintaxe do mysql para acesso a json para o mariadb.
