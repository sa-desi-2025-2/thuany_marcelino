CREATE TABLE Usuario ( 
id_usuario INT PRIMARY KEY AUTO_INCREMENT, 
nome VARCHAR(100), 
email VARCHAR(100), 
nome_usuario VARCHAR(100), 
senha VARCHAR(100) DEFAULT('a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'), 
tipo_acesso BINARY, 
status_acesso ENUM('ativo', 'inativo') 
);

CREATE TABLE Linha ( 
id_linha INT PRIMARY KEY AUTO_INCREMENT, 
nome_linha VARCHAR(100), 
);

CREATE TABLE Maquina ( 
id_maquina INT PRIMARY KEY AUTO_INCREMENT, 
nome_maquina VARCHAR(100), 
id_linha INT, 
FOREIGN KEY (id_linha) REFERENCES linha(id_linha) );

CREATE TABLE Ewo ( 
id_ewo INT PRIMARY KEY AUTO_INCREMENT, 
numero_ewo VARCHAR(100), 
link_documento TEXT, 
quadro_status BOOLEAN, 
id_maquina INT, 
FOREIGN KEY (id_maquina) REFERENCES maquina(id_maquina) );