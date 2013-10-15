DELIMITER |
CREATE PROCEDURE cadastro_cliente(app_nome VARCHAR(30), app_email VARCHAR(20),  
  app_senha VARCHAR(16), app_evento VARCHAR(100), app_descricao VARCHAR(1000))

BEGIN
    DECLARE teste VARCHAR(20);

    SELECT email INTO teste FROM admin WHERE app_email = email;
    IF teste IS NULL THEN
        INSERT INTO cliente (nome, email, senha, evento, descricao, acesso, data_cadastro)
          VALUES (app_nome, app_email, app_senha, app_evento, app_descricao, 1, curdate());
 
        SELECT id, nome, email, evento, descricao, acesso, data_cadastro
        FROM cliente
        WHERE app_email = email;
    END IF;
END

|

CREATE PROCEDURE cadastro_admin(app_email VARCHAR(20), app_senha VARCHAR(16))

BEGIN
    DECLARE teste VARCHAR(20);

    SELECT email INTO teste FROM cliente WHERE app_email = email;
    IF teste IS NULL THEN
        INSERT INTO admin (email, senha)
          VALUES (app_email, app_senha);
 
        SELECT id, email FROM admin WHERE app_email = email;
    END IF;
END

|

CREATE PROCEDURE login(app_email VARCHAR(20), app_senha VARCHAR(16))

BEGIN

    DECLARE teste VARCHAR(20);    
    
    SELECT email INTO teste FROM admin WHERE app_email = email;
    IF teste IS NULL THEN    
        SELECT id, nome, email, acesso, data_cadastro
        FROM cliente
        WHERE app_email = email AND app_senha = senha;
    ELSE SELECT id, email FROM admin WHERE app_email = email AND app_senha = senha;
    END IF;
END

|

CREATE PROCEDURE criacao_pasta(app_nome VARCHAR(30), app_id_cliente INT)

BEGIN
	DECLARE temp_id INT;
	
	INSERT INTO pasta (nome) VALUES (app_nome);
	SELECT id INTO temp_id FROM pasta WHERE app_nome = nome;
	INSERT INTO cliente_pasta (id_cliente, id_pasta) VALUES (app_id_cliente, temp_id);
	
	SELECT id, nome FROM pasta WHERE app_nome = nome;
	
END

|

CREATE PROCEDURE adicao_de_fotos(app_nome VARCHAR(50), app_id_pasta INT)

BEGIN
	DECLARE temp_id INT;
	
	INSERT INTO fotos (nome) VALUES (app_nome);
	SELECT id INTO temp_id FROM fotos WHERE app_nome = nome;
	INSERT INTO pasta_fotos (id_pasta, id_foto) VALUES (app_id_pasta, temp_id);
	
	SELECT id, nome FROM fotos WHERE app_nome = nome;
	
END;


revoke all privileges on *.* from 'admin'@'localhost';
grant all privileges on life.* to 'admin'@'localhost';
revoke all privileges on *.* from 'cliente'@'localhost';
GRANT SELECT ON mysql.proc TO 'cliente'@'localhost';
GRANT INSERT ON mysql.proc TO 'cliente'@'localhost';
GRANT UPDATE ON mysql.proc TO 'cliente'@'localhost';
GRANT EXECUTE ON PROCEDURE life.cadastro_cliente to 'cliente'@'localhost';
GRANT EXECUTE ON PROCEDURE life.login to 'cliente'@'localhost';
