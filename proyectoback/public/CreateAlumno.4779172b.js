import {
    _ as l,
    G as u,
    R as c,
    Q as o,
    z as d,
    $ as i,
    a0 as m,
    Y as p,
    Z as _,
} from "./index.0e7ae2fe.js";
const h = {
        data() {
            return { nuevoAlumno: { nombre: "" } };
        },
        methods: {
            async crearAlumno() {
                try {
                    if (
                        !(
                            await fetch("http://localhost:9000/api/alumnos", {
                                method: "POST",
                                headers: { "Content-Type": "application/json" },
                                body: JSON.stringify(this.nuevoAlumno),
                            })
                        ).ok
                    )
                        throw new Error("Error al crear el alumno");
                    this.$router.push("/");
                } catch (e) {
                    console.error("Error al crear el alumno:", e);
                }
            },
        },
    },
    n = (e) => (p("data-v-4a45dccb"), (e = e()), _(), e),
    v = n(() => o("h1", null, "Create Alumno", -1)),
    b = n(() => o("label", { for: "nombre" }, "Nombre:", -1)),
    f = n(() =>
        o("div", null, [o("button", { type: "submit" }, "Crear Alumno")], -1)
    );
function A(e, r, y, w, a, s) {
    return (
        u(),
        c("div", null, [
            v,
            o(
                "form",
                {
                    onSubmit:
                        r[1] ||
                        (r[1] = m(
                            (...t) => s.crearAlumno && s.crearAlumno(...t),
                            ["prevent"]
                        )),
                },
                [
                    o("div", null, [
                        b,
                        d(
                            o(
                                "input",
                                {
                                    type: "text",
                                    id: "nombre",
                                    "onUpdate:modelValue":
                                        r[0] ||
                                        (r[0] = (t) =>
                                            (a.nuevoAlumno.nombre = t)),
                                    required: "",
                                },
                                null,
                                512
                            ),
                            [[i, a.nuevoAlumno.nombre]]
                        ),
                    ]),
                    f,
                ],
                32
            ),
        ])
    );
}
var S = l(h, [
    ["render", A],
    ["__scopeId", "data-v-4a45dccb"],
]);
export { S as default };
