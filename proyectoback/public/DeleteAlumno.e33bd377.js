import {
    _ as i,
    G as u,
    R as c,
    Q as r,
    N as m,
    Y as d,
    Z as p,
} from "./index.0e7ae2fe.js";
const h = {
        data() {
            return { alumno: {} };
        },
        methods: {
            async obtenerAlumno() {
                const o = this.$route.params.id;
                try {
                    const e = await fetch(
                            `http://localhost:9000/api/alumnos/${o}`
                        ),
                        a = e.headers.get("content-type");
                    if (!a || !a.includes("application/json"))
                        throw new Error("La respuesta no es un JSON v\xE1lido");
                    const t = await e.json();
                    this.alumno = t;
                } catch (e) {
                    console.error("Error al obtener el alumno:", e);
                }
            },
            async eliminarAlumno() {
                const o = this.$route.params.id;
                try {
                    if (
                        !(
                            await fetch(
                                `http://localhost:9000/api/alumnos/${o}`,
                                { method: "DELETE" }
                            )
                        ).ok
                    )
                        throw new Error("Error al eliminar el alumno");
                    this.$router.push("/");
                } catch (e) {
                    console.error("Error al eliminar el alumno:", e);
                }
            },
        },
        created() {
            this.obtenerAlumno();
        },
    },
    _ = (o) => (d("data-v-372abdda"), (o = o()), p(), o),
    E = _(() => r("h1", null, "Eliminar Alumno", -1));
function f(o, e, a, t, s, n) {
    return (
        u(),
        c("div", null, [
            E,
            r(
                "p",
                null,
                "\xBFEst\xE1s seguro de que deseas eliminar a " +
                    m(s.alumno.nombre) +
                    "?",
                1
            ),
            r(
                "button",
                {
                    onClick:
                        e[0] ||
                        (e[0] = (...l) =>
                            n.eliminarAlumno && n.eliminarAlumno(...l)),
                },
                "Eliminar"
            ),
        ])
    );
}
var v = i(h, [
    ["render", f],
    ["__scopeId", "data-v-372abdda"],
]);
export { v as default };
