CREATE DATABASE avaliacao;
 

/* Criação da tabela de Produto */
CREATE TABLE tbproduto (
	procodigo INT AUTO_INCREMENT NOT NULL PRIMARY KEY COMMENT 'Código do produto',
    prodescricao VARCHAR(100) NOT NULL COMMENT 'Descrição do produto',
    provalorunidade DECIMAL(10,2) NOT NULL COMMENT 'Valor do produto',
    proestoque BIGINT NOT NULL COMMENT 'Estoque do produto',
    procodigobarra BIGINT NOT NULL COMMENT 'Código de barras do produto'
);
/* Criação de indice para tabela de produto */
CREATE INDEX ind_procodigo ON tbproduto (procodigo);

/* Adicionando uma UNIQUE para os códigos de barra */
ALTER TABLE  tbproduto ADD CONSTRAINT procodigo_barra_unique UNIQUE (procodigobarra);

/* Criação da tabela de venda */
CREATE TABLE tbvenda (
	vencodigo INT AUTO_INCREMENT NOT NULL PRIMARY KEY COMMENT 'Código da venda',
    venquantidade BIGINT NOT NULL COMMENT 'Quantidade de produto na venda',
    venvalortotal DECIMAL (10,2) NOT NULL COMMENT 'Valor total da venda',
    vendata TIMESTAMP NOT NULL COMMENT 'Data da venda',
    venvalorunidade DECIMAL (10,2) NOT NULL COMMENT 'Valor da unidade do Produto na venda',
    procodigo INT NOT NULL COMMENT 'Código do produto'
);
/* Alterando para adicionar uma FK com Produto */
ALTER TABLE tbvenda ADD CONSTRAINT fk_produto_venda FOREIGN KEY (procodigo) REFERENCES tbproduto(procodigo);

/* Criação de indice para tabela de venda */
CREATE INDEX ind_vencodigo ON tbvenda (vencodigo);

/* Criação a tabela de lixo */
CREATE TABLE tblixo (
	lixcodigo INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    lixdata TIMESTAMP NOT NULL,
    lixdado JSON NOT NULL
);
/* Criação de indique para tabela de lixo */
CREATE INDEX ind_lixcodigo ON tblixo(lixcodigo);

/* Povoando a tabela de Produto */
INSERT INTO tbproduto (procodigo, prodescricao, provalorunidade, proestoque, procodigobarra) VALUES (1, 'Mouse', 120, 10, 78787878);
INSERT INTO tbproduto (procodigo, prodescricao, provalorunidade, proestoque, procodigobarra) VALUES (2, 'Teclado', 449.99, 8, 71717171);
INSERT INTO tbproduto (procodigo, prodescricao, provalorunidade, proestoque, procodigobarra) VALUES (3, 'Monitor', 999, 3, 71717123);
INSERT INTO tbproduto (procodigo, prodescricao, provalorunidade, proestoque, procodigobarra) VALUES (4, 'Computador', 3800, 3, 777777);

/* Povoando tabela de Venda */
INSERT INTO tbvenda (vencodigo, venquantidade, venvalortotal, vendata, procodigo) VALUES (1, 2, 240, NOW(), 1);
INSERT INTO tbvenda (vencodigo, venquantidade, venvalortotal, vendata, procodigo) VALUES (3, 1, 449.99, '2023-09-03 23:49:12', 2);
