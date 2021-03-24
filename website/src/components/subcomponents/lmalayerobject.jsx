import AsyncImage from '../../asyncimage.js';

const Lmaobject = ({name}) => {
    return (
        <tr>
            <td>
                <p>{name}</p>
            </td>
            <td>
                <AsyncImage src={"images/webp/lmalayers/" + name + ".webp"}/>
            </td>
        </tr>
  );
};

export default Lmaobject