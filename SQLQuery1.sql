use Stand;



Create Table Vendas_automoveis(
id_venda int IDENTITY(1,1) PRIMARY KEY,
id_carros int,
id_col int,
id_cliente int,
data_venda date,
);

Create Table Clientes(
id_cliente int IDENTITY(1,1) PRIMARY KEY,
nome VARCHAR(100),
morada VARCHAR(100),
telefone int,
email VARCHAR(150),
cc_cartao int
);

Create Table Colaboradores(
id_col int IDENTITY(1,1) PRIMARY KEY,
nome VARCHAR(100),
salario decimal(10,2),
morada VARCHAR(200),
telefone VARCHAR(15),
email VARCHAR(150)
);

Create Table Automoveis (
id_carros int IDENTITY(1,1) PRIMARY KEY,
marca varchar(200),
modelo varchar(200),
preco_venda decimal,
quilometros int,
caixa varchar(200),
ano_lancamento date,
tipo_combustivel varchar(200),
condicao varchar(200),
id_fornecedor int
);

Create Table Fornecedores(
id_fornecedor int IDENTITY(1,1) PRIMARY KEY,
nome VARCHAR(200),
contacto int,
preco_compra decimal
);


ALTER TABLE Vendas_automoveis ADD CONSTRAINT cliente_da_fk FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente);
ALTER TABLE Vendas_automoveis ADD CONSTRAINT automoveis_da_fk FOREIGN KEY (id_carros) REFERENCES Automoveis(id_carros);
ALTER TABLE Vendas_automoveis ADD CONSTRAINT colaboradores_da_fk FOREIGN KEY (id_col) REFERENCES Colaboradores(id_col);
ALTER TABLE Automoveis ADD CONSTRAINT fornecedor_da_fk FOREIGN KEY (id_fornecedor) REFERENCES Fornecedores(id_fornecedor);

