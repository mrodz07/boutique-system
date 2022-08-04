/* PRICE HISTORY TRIGGER */
CREATE FUNCTION save_price_history ()
  RETURNS TRIGGER
  LANGUAGE PLPGSQL
AS $$
DECLARE 
BEGIN
  INSERT INTO historial_precio (id, id_inventario, fecha, precio) VALUES (DEFAULT, NEW.id, DEFAULT, NEW.precio); 
  RETURN NEW;
END;
$$;

/* Asociación trigger */
CREATE TRIGGER save_price_on_update
AFTER UPDATE
  ON inventario 
  FOR EACH ROW
EXECUTE PROCEDURE save_price_history();

CREATE TRIGGER save_price_on_insert
AFTER INSERT
  ON inventario 
  FOR EACH ROW
EXECUTE PROCEDURE save_price_history();
