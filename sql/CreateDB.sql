BEGIN WORK;

CREATE DOMAIN tipo_acesso AS TEXT CHECK(value IN ('administrador', 'bibliotecário'));

CREATE DOMAIN status_exemplar AS TEXT CHECK(value IN ('livre', 'locado', 'perdido', 'reservado'));

CREATE TABLE usuario(
	id_usuario BIGSERIAL PRIMARY KEY,
	nome CHARACTER VARYING NOT NULL,
	acesso CHARACTER VARYING NOT NULL UNIQUE CHECK(LENGTH(acesso) >= 3),
	senha CHARACTER VARYING NOT NULL,
	tipo_acesso tipo_acesso NOT NULL,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW(),
	observacao CHARACTER VARYING,
	inativo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE escritor(
	id_escritor BIGSERIAL PRIMARY KEY,
	nome CHARACTER VARYING NOT NULL UNIQUE,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW()
);

CREATE TABLE categoria(
	id_categoria BIGSERIAL PRIMARY KEY,
	categoria CHARACTER VARYING NOT NULL UNIQUE,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW()
);

CREATE TABLE corredor(
	id_corredor BIGSERIAL PRIMARY KEY,
	corredor CHARACTER VARYING NOT NULL UNIQUE,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW(),
	inativo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE prateleira(
	id_prateleira BIGSERIAL PRIMARY KEY,
	id_corredor BIGINT NOT NULL REFERENCES corredor(id_corredor) ON DELETE RESTRICT ON UPDATE CASCADE,
	prateleira CHARACTER VARYING NOT NULL UNIQUE,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW(),
	inativo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE livro(
	id_livro BIGSERIAL PRIMARY KEY,
	codigo CHARACTER VARYING NOT NULL UNIQUE,
	titulo CHARACTER VARYING NOT NULL,
	isbn CHARACTER VARYING,
	id_escritor BIGINT REFERENCES escritor(id_escritor) ON DELETE RESTRICT ON UPDATE CASCADE,
	id_categoria BIGINT REFERENCES categoria(id_categoria) ON DELETE RESTRICT ON UPDATE CASCADE,
	id_prateleira BIGINT NOT NULL REFERENCES prateleira(id_prateleira) ON DELETE RESTRICT ON UPDATE CASCADE,
	edicao CHARACTER VARYING,
	numero_paginas INT,
	ano CHAR(4),
	uf CHAR(2),
	observacao CHARACTER VARYING,
	inativo BOOLEAN NOT NULL DEFAULT FALSE,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW()
);

CREATE TABLE exemplar(
	id_exemplar BIGSERIAL PRIMARY KEY,
	id_livro BIGINT NOT NULL REFERENCES livro(id_livro) ON DELETE CASCADE ON UPDATE CASCADE,
	codigo CHARACTER VARYING NOT NULL UNIQUE,
	observacao CHARACTER VARYING,
	status_exemplar status_exemplar NOT NULL,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW(),
	inativo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE pessoa(
	id_pessoa BIGSERIAL PRIMARY KEY,
	codigo CHARACTER VARYING NOT NULL UNIQUE,
	nome CHARACTER VARYING NOT NULL,
	telefone CHARACTER VARYING,
	email CHARACTER VARYING,
	observacao CHARACTER VARYING,
	inativo BOOLEAN NOT NULL DEFAULT FALSE,
	criado_em TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT NOW()
);

CREATE TABLE pessoa_campo_extra(
	id_pessoa_campo_extra BIGSERIAL PRIMARY KEY,
	campo CHARACTER VARYING NOT NULL UNIQUE,
	obrigatorio BOOLEAN NOT NULL DEFAULT FALSE,
	observacao CHARACTER VARYING,
	inativo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE pessoa_campo_extra_valor(
	id_pessoa_campo_extra_valor BIGSERIAL PRIMARY KEY,
	id_pessoa BIGINT NOT NULL REFERENCES pessoa(id_pessoa) ON DELETE CASCADE ON UPDATE CASCADE,
	id_pessoa_campo_extra BIGINT NOT NULL REFERENCES pessoa_campo_extra(id_pessoa_campo_extra) ON DELETE RESTRICT ON UPDATE CASCADE,
	valor CHARACTER VARYING NOT NULL
);

CREATE TABLE locacao(
	id_locacao BIGSERIAL PRIMARY KEY,
	id_usuario BIGINT NOT NULL REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE,
	id_exemplar BIGINT NOT NULL REFERENCES exemplar(id_exemplar) ON DELETE RESTRICT ON UPDATE CASCADE,
	id_pessoa BIGINT NOT NULL REFERENCES pessoa(id_pessoa) ON DELETE RESTRICT ON UPDATE CASCADE,
	data_locacao DATE NOT NULL DEFAULT NOW(),
	data_planejada_entrega DATE NOT NULL,
	data_entrega DATE,
	observacao CHARACTER VARYING,
	encerrada BOOLEAN NOT NULL DEFAULT FALSE,
	multa DECIMAL(15, 2) NOT NULL DEFAULT 0
);

CREATE TABLE config_locacao(
	dias_para_locacao INTEGER CHECK(dias_para_locacao > 0) NOT NULL,
	valor_multa_por_dia DECIMAL(15,2) CHECK(valor_multa_por_dia >= 0) NOT NULL,
	dias_prazo_retirada INTEGER CHECK(dias_prazo_retirada > 0) NOT NULL,
	numero_maximo_locacoes INTEGER CHECK(numero_maximo_locacoes >= 0) NOT NULL
);

CREATE TABLE config_ajustes(
	exibir_pessoas_inativas BOOLEAN NOT NULL
);

CREATE OR REPLACE FUNCTION get_config_dias_prazo_retirada() 
RETURNS int LANGUAGE SQL AS
$$ SELECT dias_prazo_retirada FROM config_locacao; $$;

CREATE TABLE reserva(
	id_reserva BIGSERIAL PRIMARY KEY,
	id_pessoa BIGINT NOT NULL REFERENCES pessoa(id_pessoa) ON DELETE RESTRICT ON UPDATE CASCADE,
	id_exemplar BIGINT NOT NULL REFERENCES exemplar(id_exemplar) ON DELETE RESTRICT ON UPDATE CASCADE,
	data_prazo_retirada DATE NOT NULL DEFAULT (NOW()::DATE + get_config_dias_prazo_retirada())
);


INSERT INTO usuario (nome, acesso, senha, tipo_acesso) VALUES ('Administrador', 'admin', '200820e3227815ed1756a6b531e7e0d2', 'administrador');

INSERT INTO config_locacao(dias_para_locacao, valor_multa_por_dia, dias_prazo_retirada, numero_maximo_locacoes) VALUES (15, 0.10, 3, 3);
INSERT INTO config_ajustes(exibir_pessoas_inativas) VALUES (false);