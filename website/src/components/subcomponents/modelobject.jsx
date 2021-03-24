import AsyncImage from '../../asyncimage.js';

const Modelobject = ({name}) => {
    return (
        <tr>
            <td>
                <p>{name}</p>
            </td>
            <td>
                <AsyncImage src={"images/webp/models/" + name + ".webp"}/>
            </td>
        </tr>
  );
};

export default Modelobject