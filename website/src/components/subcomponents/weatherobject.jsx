const Weatherobject = ({name}) => {
    return (
        <tr>
            <td>
                <p>{name}</p>
            </td>
            <td>
                <video controls muted>
                    <source src={"videos/webm/weather/" + name + ".webm"} type="video/webm"/>
                    <source src={"videos/mp4/weather/" + name + ".mp4"} type="video/mp4"/>
                </video>
            </td>
        </tr>
  );
};

export default Weatherobject