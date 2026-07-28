-- Adds admin@almmora.com with its own permission group that can't see "Permission Setting".
-- Safe to run more than once (each step checks before inserting).

-- 1. Make sure the new permission group exists.
INSERT INTO permission_groups (group_name, status, created_at, updated_at, created_by, updated_by)
SELECT 'Admin (Almmora)', 1, NOW(), NOW(), 'AD000001', 'AD000001'
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM permission_groups WHERE group_name = 'Admin (Almmora)');

SET @group_id = (SELECT id FROM permission_groups WHERE group_name = 'Admin (Almmora)' LIMIT 1);

-- 2. Find which permission_lvl the existing admin account uses (falls back to 2 if not found).
SET @base_lvl = (SELECT permission_lvl FROM admins WHERE email = 'admin@vesson.my' LIMIT 1);
SET @base_lvl = COALESCE(@base_lvl, 2);

-- 3. Grant the existing admin group "permission-control", so their access is unchanged.
INSERT INTO permissions (permission_lvl, page, sorting, status, created_at, updated_at)
SELECT @base_lvl, 'permission-control', NULL, 1, NOW(), NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM permissions WHERE permission_lvl = @base_lvl AND page = 'permission-control');

-- 4. Copy every other permission from the existing admin group into the new group
--    (skipped entirely if the new group already has permissions, i.e. already run before).
INSERT INTO permissions (permission_lvl, page, sorting, status, created_at, updated_at)
SELECT @group_id, page, sorting, status, NOW(), NOW()
FROM permissions
WHERE permission_lvl = @base_lvl
  AND page != 'permission-control'
  AND NOT EXISTS (SELECT 1 FROM permissions WHERE permission_lvl = @group_id);

-- 5. Create the admin@almmora.com account (password: admin1234), in the new group.
SET @next_num = (SELECT MAX(CAST(SUBSTRING(code, 3) AS UNSIGNED)) + 1 FROM admins);
SET @next_code = CONCAT('AD', LPAD(@next_num, 6, '0'));

INSERT INTO admins (code, email, password, f_name, l_name, website_logo, lvl, permission_lvl, status, created_at, updated_at)
SELECT @next_code, 'admin@almmora.com', '$2y$10$fV./uRNE5BsXq1QWLm.OQuZsrYFM1mmRk9c19oGaqGKehF.iUeI0O', 'Admin', 'Almmora', '', 2, @group_id, 1, NOW(), NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM admins WHERE email = 'admin@almmora.com');
