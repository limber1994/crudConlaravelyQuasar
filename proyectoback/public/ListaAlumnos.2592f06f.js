import {
    _ as u,
    G as a,
    R as r,
    Q as o,
    U as d,
    S as m,
    N as p,
    Y as _,
    Z as h,
} from "./index.0e7ae2fe.js";
const y = {
        data() {
            return { alumnos: [] };
        },
        methods: {
            async obtenerAlumnos() {
                try {
                    const e = await fetch("http://localhost:9000/api/alumnos"),
                        t = e.headers.get("content-type");
                    if (!t || !t.includes("application/json"))
                        throw new Error("La respuesta no es un JSON v\xE1lido");
                    const n = await e.json();
                    console.log("Datos de alumnos obtenidos:", n),
                        (this.alumnos = n);
                } catch (e) {
                    console.error("Error al obtener los alumnos:", e);
                }
            },
            async eliminarAlumno(e) {
                try {
                    if (
                        !(
                            await fetch(
                                `http://localhost:9000/api/alumnos/${e}`,
                                { method: "DELETE" }
                            )
                        ).ok
                    )
                        throw new Error("Error al eliminar el alumno");
                    this.obtenerAlumnos();
                } catch (t) {
                    console.error("Error al eliminar el alumno:", t);
                }
            },
        },
        created() {
            this.obtenerAlumnos();
        },
    },
    l = (e) => (_("data-v-96eeaa0a"), (e = e()), h(), e),
    b = l(() => o("h1", null, "Lista de Alumnos", -1)),
    f = l(() =>
        o(
            "thead",
            null,
            [
                o("tr", null, [
                    o("th", null, "Nombre"),
                    o("th", null, "Acciones"),
                ]),
            ],
            -1
        )
    ),
    E = ["onClick"];
function v(e, t, n, A, c, i) {
    return (
        a(),
        r("div", null, [
            b,
            o("table", null, [
                f,
                o("tbody", null, [
                    (a(!0),
                    r(
                        d,
                        null,
                        m(
                            c.alumnos,
                            (s) => (
                                a(),
                                r("tr", { key: s.id }, [
                                    o("td", null, p(s.nombre), 1),
                                    o("td", null, [
                                        o(
                                            "button",
                                            {
                                                onClick: (w) =>
                                                    i.eliminarAlumno(s.id),
                                            },
                                            "Eliminar",
                                            8,
                                            E
                                        ),
                                    ]),
                                ])
                            )
                        ),
                        128
                    )),
                ]),
            ]),
        ])
    );
}
var L = u(y, [
    ["render", v],
    ["__scopeId", "data-v-96eeaa0a"],
]);
export { L as default };
