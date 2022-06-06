/* PRICE HISTORY TRIGGER */
CREATE FUNCTION save_spec_on_inventory ()
  RETURNS TRIGGER
  LANGUAGE PLPGSQL
AS $$
DECLARE 
BEGIN
  INSERT INTO inventario (id, id_especificacion, id_estado, cantidad, precio, fecha_ingreso) VALUES (DEFAULT, NEW.id, 1, 0, 0, DEFAULT); 
  INSERT INTO inventario (id, id_especificacion, id_estado, cantidad, precio, fecha_ingreso) VALUES (DEFAULT, NEW.id, 2, 0, 0, DEFAULT); 
  INSERT INTO inventario (id, id_especificacion, id_estado, cantidad, precio, fecha_ingreso) VALUES (DEFAULT, NEW.id, 3, 0, 0, DEFAULT); 
  INSERT INTO inventario (id, id_especificacion, id_estado, cantidad, precio, fecha_ingreso) VALUES (DEFAULT, NEW.id, 4, 0, 0, DEFAULT); 
  RETURN NEW;
END;
$$;

/* Asociación trigger */
CREATE TRIGGER save_inventory
AFTER INSERT
  ON especificacion 
  FOR EACH ROW
EXECUTE PROCEDURE save_spec_on_inventory();
